<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\userResource;
use App\Models\User;
use App\Services\userService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    protected $userService;

    public function __construct(userService $userService)
    {

        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        try {
            $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 0;
            $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'id';
            $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

            $data = $this->userService->list($request, $orderByField, $orderByOrder, $paginate);

            $users = User::all();
            return response()->json($data, 200);
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
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }



            $this->userService->create($request->all());



            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
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
            $data =  $this->userService->find($id);

            return response()->json([
                'status' => true,
                'user' => $data,
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
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }



            $this->userService->update($request->all(), $id);



            return response()->json([
                'status' => true,
                'message' => 'User Updated Successfully',
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
            $this->userService->destroy($id);

            return response()->json([
                'status' => true,
                'message' => 'User Deleted Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
