<?php

class EnrollmentService
{
    public function __construct(
        private EnrollmentRepository $repository
    ) {
    }

    public function countAll(
        string $keyword = '',
        int $userId
    ): int {
        return $this->repository->countAll(
            $keyword,
            $userId
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

        return $this->repository->getPaginated(
            $keyword,
            $limit,
            $offset,
            $sort,
            $direction,
            $userId
        );
    }

    public function findById(
        int $id,
        int $userId
    ): ?array {

        return $this->repository->findById(
            $id,
            $userId
        );
    }

    public function create(array $data): bool
    {
        return $this->repository->create($data);
    }

    public function update(
        int $id,
        array $data,
        int $userId
    ): bool {

        return $this->repository->update(
            $id,
            $data,
            $userId
        );
    }

    public function delete(
        int $id,
        int $userId
    ): bool {

        return $this->repository->delete(
            $id,
            $userId
        );
    }
}