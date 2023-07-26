<?php

namespace App\Services;

use App\Repositories\userRepository;

class userService
{
    protected $userRepository;

    public function __construct(userRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($data)
    {
        return $this->userRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate)
    {
        return $this->userRepository->list($request, $orderByField, $orderByOrder, $paginate);
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    public function first($data)
    {
        return $this->userRepository->first($data);
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }

    public function recoveryPassword($email)
    {
        return $this->userRepository->RecoveryPassword($email);
    }
}
