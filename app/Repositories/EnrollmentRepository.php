<?php

class EnrollmentRepository
{
    public function __construct(private PDO $db)
    {
    }


    public function countAll(
        string $keyword = '',
        int $userId
    ): int {

        $sql = "
            SELECT COUNT(*) AS total
            FROM enrollments
            WHERE user_id = :user_id
        ";


        $params = [
            'user_id' => $userId
        ];



        if ($keyword !== '') {

            $sql .= "
                AND (
                    status LIKE :keyword
                    OR student_id LIKE :keyword
                    OR course_id LIKE :keyword
                )
            ";


            $params['keyword'] = "%{$keyword}%";
        }



        $stmt = $this->db->prepare($sql);

        $stmt->execute($params);


        return (int)(
            $stmt->fetch()['total'] ?? 0
        );
    }




    public function getPaginated(
        string $keyword,
        int $limit,
        int $offset,
        string $sort,
        string $direction,
        int $userId
    ): array {



        $allowedSorts = [
            'id',
            'student_id',
            'course_id',
            'enroll_date',
            'status'
        ];


        $allowedDirections = [
            'asc',
            'desc'
        ];



        if (!in_array(
            $sort,
            $allowedSorts,
            true
        )) {

            $sort = 'id';

        }



        $direction = strtolower($direction);



        if (!in_array(
            $direction,
            $allowedDirections,
            true
        )) {

            $direction = 'desc';

        }




        $sql = "
            SELECT
                id,
                student_id,
                course_id,
                enroll_date,
                status,
                user_id
            FROM enrollments
            WHERE user_id = :user_id
        ";



        $params = [

            'user_id'=>$userId

        ];




        if($keyword !== ''){


            $sql .= "
                AND (
                    status LIKE :keyword
                    OR student_id LIKE :keyword
                    OR course_id LIKE :keyword
                )
            ";


            $params['keyword']
                = "%{$keyword}%";

        }




        $sql .= "
            ORDER BY {$sort} {$direction}
            LIMIT :limit
            OFFSET :offset
        ";




        $stmt = $this->db->prepare($sql);



        foreach($params as $key=>$value){


            $stmt->bindValue(
                ":$key",
                $value,
                PDO::PARAM_STR
            );

        }




        $stmt->bindValue(
            ':limit',
            $limit,
            PDO::PARAM_INT
        );


        $stmt->bindValue(
            ':offset',
            $offset,
            PDO::PARAM_INT
        );



        $stmt->execute();



        return $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );

    }





    public function findById(
        int $id,
        int $userId
    ): ?array {


        $stmt = $this->db->prepare(
            "
            SELECT *
            FROM enrollments
            WHERE id = :id
            AND user_id = :user_id
            "
        );



        $stmt->execute([

            'id'=>$id,

            'user_id'=>$userId

        ]);



        return $stmt->fetch(
            PDO::FETCH_ASSOC
        ) ?: null;

    }





    public function create(array $data): bool
    {


        $sql = "
            INSERT INTO enrollments
            (
                student_id,
                course_id,
                enroll_date,
                status,
                user_id
            )
            VALUES
            (
                :student_id,
                :course_id,
                :enroll_date,
                :status,
                :user_id
            )
        ";



        $stmt = $this->db->prepare($sql);



        return $stmt->execute([

            'student_id'=>(int)$data['student_id'],

            'course_id'=>(int)$data['course_id'],

            'enroll_date'=>$data['enroll_date'],

            'status'=>$data['status'],

            'user_id'=>(int)$data['user_id']

        ]);

    }





    public function update(
        int $id,
        array $data,
        int $userId
    ): bool {


        $sql = "
            UPDATE enrollments
            SET
                student_id = :student_id,
                course_id = :course_id,
                enroll_date = :enroll_date,
                status = :status
            WHERE id = :id
            AND user_id = :user_id
        ";



        $stmt=$this->db->prepare($sql);



        return $stmt->execute([

            'id'=>$id,

            'student_id'=>(int)$data['student_id'],

            'course_id'=>(int)$data['course_id'],

            'enroll_date'=>$data['enroll_date'],

            'status'=>$data['status'],

            'user_id'=>$userId

        ]);

    }





    public function delete(
        int $id,
        int $userId
    ): bool {


        $stmt=$this->db->prepare(
            "
            DELETE FROM enrollments
            WHERE id = :id
            AND user_id = :user_id
            "
        );



        return $stmt->execute([

            'id'=>$id,

            'user_id'=>$userId

        ]);

    }

}