<?php

class UserRepository
{
    public function __construct(
        private PDO $db
    ) {}


    public function findByUsername(string $username): ?array
    {
        $sql = "
            SELECT *
            FROM users
            WHERE username = :username
            LIMIT 1
        ";


        $stmt = $this->db->prepare($sql);


        $stmt->execute([
            'username'=>$username
        ]);


        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        return $user ?: null;
    }
}