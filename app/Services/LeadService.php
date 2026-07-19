<?php

class LeadService
{
    public function __construct(
        private LeadRepository $repository
    ) {
    }


    public function create(array $data): bool
    {
        return $this->repository->create($data);
    }
}