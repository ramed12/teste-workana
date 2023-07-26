<?php

namespace App\Repositories;

use App\Models\Author;

class authorRepository
{
    protected $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function create($data)
    {
        return $this->author->create($data);
    }

    public function update($data, $id)
    {
        return tap($this->author->findOrFail($id))->update($data);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate)
    {

        $fillable = $this->author->getFillable();
        $author = $this->author->orderBy($orderByField, $orderByOrder);

        foreach ($request->all() as $field => $filter) {
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                        if ($request->input($field)) {
                            $author->whereDate($field, $filter);
                        }
                        break;
                    case 'name':
                        if ($request->input($field)) {
                            $author->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    case 'email':
                        if ($request->input($field)) {
                            $author->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    default:
                        if ($request->input($field)) {
                            $author->where($field, $filter);
                        }
                        break;
                }
            }
        }

        return $author->paginate($paginate);
    }

    public function find($id)
    {
        return $this->author->findOrFail($id);
    }

    public function first($data)
    {

        $fillable = $this->author->getFillable();
        $author     = $this->author;

        foreach ($data as $field => $filter) {

            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                        if ($data->input($field)) {
                            $author->whereDate($field, $filter);
                        }
                        break;
                    case 'name':
                        if ($data->input($field)) {
                            $author->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    default:
                        if ($data->input($field)) {
                            $author->where($field, $filter);
                        }
                        break;
                }
            }
        }

        return $author->first();
    }

    public function destroy($id)
    {
        return tap($this->author->findOrFail($id))->delete();
    }

    public function RecoveryPassword($email)
    {
        return $this->author->where('email', $email)->first();
    }
}
