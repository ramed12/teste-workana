<?php

namespace App\Services;

use App\Repositories\bookRepository;

class bookService
{
    protected $bookRepository;

    public function __construct(bookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function create($data)
    {
        return $this->bookRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->bookRepository->update($data, $id);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate)
    {
        return $this->bookRepository->list($request, $orderByField, $orderByOrder, $paginate);
    }

    public function find($id)
    {
        return $this->bookRepository->find($id);
    }

    public function first($data)
    {
        return $this->bookRepository->first($data);
    }

    public function destroy($id)
    {
        return $this->bookRepository->destroy($id);
    }

    public function recoveryPassword($email)
    {
        return $this->bookRepository->RecoveryPassword($email);
    }
}
