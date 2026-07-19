<?php

class StudentRepository
{
    public function __construct(private PDO $db)
    {
    }

    public function countAll(string $keyword = ''): int
    {
        $sql = "SELECT COUNT(*) AS total FROM students";
        $params = [];

        if ($keyword !== '') {
            $sql .= " WHERE full_name LIKE :keyword
                      OR email LIKE :keyword
                      OR phone LIKE :keyword";

            $params['keyword'] = "%{$keyword}%";
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

        $allowedSorts = [
            'id',
            'full_name',
            'email',
            'phone',
            'created_at'
        ];

        $allowedDirections = [
            'asc',
            'desc'
        ];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'created_at';
        }

        $direction = strtolower($direction);

        if (!in_array($direction, $allowedDirections, true)) {
            $direction = 'desc';
        }

        $sql = "
            SELECT
                id,
                full_name,
                email,
                phone,
                created_at
            FROM students
        ";

        $params = [];

        if ($keyword !== '') {
            $sql .= "
                WHERE full_name LIKE :keyword
                   OR email LIKE :keyword
                   OR phone LIKE :keyword
            ";

            $params['keyword'] = "%{$keyword}%";
        }

        $sql .= " ORDER BY {$sort} {$direction}
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        if (!empty($params)) {
            $stmt->bindValue(':keyword', $params['keyword'], PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM students
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO students(
                full_name,
                email,
                phone
            )
            VALUES(
                :full_name,
                :email,
                :phone
            )
        ";

        try {

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?: null
            ]);

        } catch (PDOException $e) {

            if (($e->errorInfo[1] ?? 0) == 1062) {
                throw new DuplicateRecordException(
                    'Student email already exists.'
                );
            }

            throw $e;
        }
    }

    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE students
            SET
                full_name = :full_name,
                email = :email,
                phone = :phone
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?: null
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM students
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id
        ]);
    }
}