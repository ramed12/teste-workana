<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\authorResource;
use App\Services\authorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class authorController extends Controller
{
    protected $authorService;

    public function __construct(authorService $authorService)
    {

        $this->authorService = $authorService;
    }

    public function index(Request $request)
    {
        try {
            $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 0;
            $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'id';
            $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

            $data = $this->authorService->list($request, $orderByField, $orderByOrder, $paginate);

            return response()->json([
                'status' => true,
                'authors' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            //Validated
            $validateauthor = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'requiredemai',
                    'age' => 'required',
                    'phone' => 'required'
                ]
            );

            if ($validateauthor->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateauthor->errors()
                ], 401);
            }



            $this->authorService->create($request->all());



            return response()->json([
                'status' => true,
                'message' => 'author Created Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {

        try {
            $data =  $this->authorService->find($id);

            return response()->json([
                'status' => true,
                'author' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {


            //Validated
            $validateauthor = Validator::make(
                $request->all(),
                [
                    'name' => 'required'
                ]
            );

            if ($validateauthor->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateauthor->errors()
                ], 401);
            }



            $this->authorService->update($request->all(), $id);



            return response()->json([
                'status' => true,
                'message' => 'author Updated Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->authorService->destroy($id);

            return response()->json([
                'status' => true,
                'message' => 'author Deleted Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
