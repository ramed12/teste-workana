<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\bookResource;
use App\Services\bookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class bookController extends Controller
{
    protected $bookService;

    public function __construct(bookService $bookService)
    {

        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {

        try {
            $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 0;
            $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'id';
            $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

            $data = $this->bookService->list($request, $orderByField, $orderByOrder, $paginate);

            return response()->json([
                'status' => true,
                'books' => $data,
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
            $validatebook = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:books,email',
                    'age' => 'required',
                    'phone' => 'required'
                ]
            );

            if ($validatebook->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatebook->errors()
                ], 401);
            }



            $this->bookService->create($request->all());



            return response()->json([
                'status' => true,
                'message' => 'book Created Successfully',
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
            $data =  $this->bookService->find($id);

            return response()->json([
                'status' => true,
                'book' => $data,
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
            $validatebook = Validator::make(
                $request->all(),
                [
                    'name' => 'required'
                ]
            );

            if ($validatebook->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatebook->errors()
                ], 401);
            }



            $this->bookService->update($request->all(), $id);



            return response()->json([
                'status' => true,
                'message' => 'book Updated Successfully',
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
            $this->bookService->destroy($id);

            return response()->json([
                'status' => true,
                'message' => 'book Deleted Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
