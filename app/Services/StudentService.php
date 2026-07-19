<?php

class StudentService
{
    public function __construct(
        private StudentRepository $repository
    ) {}


    public function countAll(string $keyword = ''): int
    {
        return $this->repository->countAll($keyword);
    }


    public function getPaginated(
        string $keyword,
        int $limit,
        int $offset,
        string $sort,
        string $direction
    ): array {

        return $this->repository->getPaginated(
            $keyword,
            $limit,
            $offset,
            $sort,
            $direction
        );
    }


    public function create(array $data): bool
    {
        return $this->repository->create($data);
    }


    public function findById(int $id): ?array
    {
        return $this->repository->findById($id);
    }


    public function update(int $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }


    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}