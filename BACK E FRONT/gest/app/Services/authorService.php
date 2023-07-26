<?php

namespace App\Services;

use App\Repositories\authorRepository;

class authorService
{
    protected $authorRepository;

    public function __construct(authorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function create($data)
    {
        return $this->authorRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->authorRepository->update($data, $id);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate)
    {
        return $this->authorRepository->list($request, $orderByField, $orderByOrder, $paginate);
    }

    public function find($id)
    {
        return $this->authorRepository->find($id);
    }

    public function first($data)
    {
        return $this->authorRepository->first($data);
    }

    public function destroy($id)
    {
        return $this->authorRepository->destroy($id);
    }

    public function recoveryPassword($email)
    {
        return $this->authorRepository->RecoveryPassword($email);
    }
}
