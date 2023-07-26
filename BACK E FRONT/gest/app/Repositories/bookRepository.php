<?php

namespace App\Repositories;

use App\Models\book;

class bookRepository
{
    protected $book;

    public function __construct(book $book)
    {
        $this->book = $book;
    }

    public function create($data)
    {
        return $this->book->create($data);
    }

    public function update($data, $id)
    {
        return tap($this->book->findOrFail($id))->update($data);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate)
    {

        $fillable = $this->book->getFillable();
        $book = $this->book->orderBy($orderByField, $orderByOrder);

        foreach ($request->all() as $field => $filter) {
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                        if ($request->input($field)) {
                            $book->whereDate($field, $filter);
                        }
                        break;
                    case 'title':
                        if ($request->input($field)) {
                            $book->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    case 'description':
                        if ($request->input($field)) {
                            $book->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    default:
                        if ($request->input($field)) {
                            $book->where($field, $filter);
                        }
                        break;
                }
            }
        }

        return $book->paginate($paginate);
    }

    public function find($id)
    {
        return $this->book->findOrFail($id);
    }

    public function first($data)
    {

        $fillable = $this->book->getFillable();
        $book     = $this->book;

        foreach ($data as $field => $filter) {

            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                        if ($data->input($field)) {
                            $book->whereDate($field, $filter);
                        }
                        break;
                    case 'title':
                        if ($data->input($field)) {
                            $book->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    case 'description':
                        if ($data->input($field)) {
                            $book->where($field, "like", "%" . $filter . "%");
                        }
                        break;
                    default:
                        if ($data->input($field)) {
                            $book->where($field, $filter);
                        }
                        break;
                }
            }
        }

        return $book->first();
    }

    public function destroy($id)
    {
        return tap($this->book->findOrFail($id))->delete();
    }

    public function RecoveryPassword($email)
    {
        return $this->book->where('email', $email)->first();
    }
}
