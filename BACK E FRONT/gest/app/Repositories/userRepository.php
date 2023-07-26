<?php

namespace App\Repositories;

use App\Models\User;

class userRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($data)
    {
        return $this->user->create($data);
    }

    public function update($data, $id)
    {
        return tap($this->user->findOrFail($id))->update($data);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate)
    {

        $fillable = $this->user->getFillable();
        $user = $this->user->orderBy($orderByField, $orderByOrder);

        foreach ($request->all() as $field => $filter) {
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                        if ($request->input($field)) {
                            $user->whereDate($field, $filter);
                        }
                        break;
                    case 'name':
                        if ($request->input($field)) {
                            $user->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    case 'email':
                        if ($request->input($field)) {
                            $user->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    default:
                        if ($request->input($field)) {
                            $user->where($field, $filter);
                        }
                        break;
                }
            }
        }

        return $user->paginate($paginate);
    }

    public function find($id)
    {
        return $this->user->findOrFail($id);
    }

    public function first($data)
    {

        $fillable = $this->user->getFillable();
        $user     = $this->user;

        foreach ($data as $field => $filter) {

            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                        if ($data->input($field)) {
                            $user->whereDate($field, $filter);
                        }
                        break;
                    case 'name':
                        if ($data->input($field)) {
                            $user->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    default:
                        if ($data->input($field)) {
                            $user->where($field, $filter);
                        }
                        break;
                }
            }
        }

        return $user->first();
    }

    public function destroy($id)
    {
        return tap($this->user->findOrFail($id))->delete();
    }

    public function RecoveryPassword($email)
    {
        return $this->user->where('email', $email)->first();
    }
}
