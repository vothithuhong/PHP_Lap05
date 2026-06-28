<?php

class EnrollmentRepository
{
    public function __construct(private PDO $db) {}

    public function countAll(string $keyword = ''): int
    {
        $sql = "SELECT COUNT(*) AS total FROM enrollments";
        $params = [];

        if ($keyword !== '') {
            $sql .= " WHERE status LIKE :kw
                      OR CAST(student_id AS CHAR) LIKE :kw
                      OR CAST(course_id AS CHAR) LIKE :kw";

            $params['kw'] = "%{$keyword}%";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int)($stmt->fetch()['total'] ?? 0);
    }

    public function getPaginated(
        string $keyword,
        int $limit,
        int $offset,
        string $sort,
        string $direction
    ): array {

        $allowedSorts = ['id', 'student_id', 'course_id', 'enroll_date', 'status'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'id';
        }

        $direction = strtolower($direction);
        if (!in_array($direction, $allowedDirections, true)) {
            $direction = 'desc';
        }

        $sql = "
            SELECT id, student_id, course_id, enroll_date, status
            FROM enrollments
        ";

        $params = [];

        if ($keyword !== '') {
            $sql .= " WHERE status LIKE :kw
                      OR student_id LIKE :kw
                      OR course_id LIKE :kw";

            $params['kw'] = "%{$keyword}%";
        }

        $sql .= " ORDER BY {$sort} {$direction}
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO enrollments (student_id, course_id, enroll_date, status)
            VALUES (:student_id, :course_id, :enroll_date, :status)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'student_id' => (int)$data['student_id'],
            'course_id' => (int)$data['course_id'],
            'enroll_date' => $data['enroll_date'],
            'status' => $data['status'],
        ]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM enrollments WHERE id = :id
        ");

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE enrollments
            SET student_id = :student_id,
                course_id = :course_id,
                enroll_date = :enroll_date,
                status = :status
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'student_id' => (int)$data['student_id'],
            'course_id' => (int)$data['course_id'],
            'enroll_date' => $data['enroll_date'],
            'status' => $data['status'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM enrollments WHERE id = :id
        ");

        return $stmt->execute(['id' => $id]);
    }
}