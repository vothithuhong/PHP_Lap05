<?php

class LeadRepository
{
    public function __construct(
        private PDO $db
    ) {
    }


    public function create(array $data): bool
    {
        try {

            $sql = "
                INSERT INTO leads
                (
                    name,
                    email,
                    phone,
                    message
                )
                VALUES
                (
                    :name,
                    :email,
                    :phone,
                    :message
                )
            ";


            $stmt = $this->db->prepare($sql);


            return $stmt->execute([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?: null,
                'message' => $data['message']
            ]);


        } catch(PDOException $e){

            if (($e->errorInfo[1] ?? null) == 1062) {

                throw new DuplicateRecordException(
                    "Email đã tồn tại"
                );
            }

            throw $e;
        }
    }
}