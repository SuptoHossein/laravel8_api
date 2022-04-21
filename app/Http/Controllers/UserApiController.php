<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserApiController extends Controller
{

    // Fetch data
    public function showUser($id = null)
    {
        if ($id == '') {
            $users = User::get();
            return response()->json(['users' => $users, 200]);
        } else {
            $users = User::find($id);
            return response()->json(['users' => $users, 200]);
        }
    }

    // add User
    public function addUser(Request $request)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email',
                'password.required' => 'Password is required',
            ];
            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'User Successfully Added';
            return response()->json(['message' => $message], 201);
        }
    }

    // Add multimple user
    public function addMultipleUser(Request $request)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'users.*.name' => 'required',
                'users.*.email' => 'required|email|unique:users',
                'users.*.password' => 'required',
            ];

            $customMessage = [
                'users.*.name.required' => 'Name is required',
                'users.*.email.required' => 'Email is required',
                'users.*.email.email' => 'Email must be a valid email',
                'users.*.password.required' => 'Password is required',
            ];
            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }


            foreach ($data['users'] as $adduser) {
                // return $user;
                $user = new User();
                $user->name = $adduser['name'];
                $user->email = $adduser['email'];
                $user->password = bcrypt($adduser['password']);
                $user->save();
                $message = 'User Successfully Added';
            }
            return response()->json(['message' => $message], 201);
        }
    }

    // Put api for update details
    public function updateUserDetails(Request $request, $id)
    {
        if ($request->ismethod('put')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'name' => 'required',
                'password' => 'required',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'password.required' => 'Password is required',
            ];
            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }


            $user = User::findOrFail($id);
            $user->name = $data['name'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'User Successfully Updated';

            return response()->json(['message' => $message], 202);
        }
    }

    // patch api for update single record
    public function updateSingleRecord(Request $request, $id)
    {
        if ($request->ismethod('patch')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'users.*.name' => 'required',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
            ];
            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }


            $user = User::findOrFail($id);
            $user->name = $data['name'];
            $user->save();
            $message = 'User Successfully Updated';

            return response()->json(['message' => $message], 202);
        }
    }


    public function deleteUser($id = null)
    {
        User::findOrFail($id)->delete();
        $message = 'User deleted';
        return response()->json(['message' => $message], 200);
    }

    // Delete user with json
    public function deleteUserJson(Request $request)
    {
        if ($request->isMethod('delete')) {
            $data = $request->all();

            User::where('id', $data['id'])->delete();
            $message = 'User deleted';
            return response()->json(['message' => $message], 200);
        }
    }


    // delete multiple user
    public function deleteMultipleUser($ids)
    {
        $ids = explode(',', $ids);
        // return $ids;

        User::whereIn('id', $ids)->delete();
        $message = 'User deleted';
        return response()->json(['message' => $message], 200);
    }

    // delete multiple user using json
    public function deleteMultipleUserJson(Request $request)
    {
        $header = $request->header('Authorization');
        if ($header == '') {
            $message = 'Authorization is required';
            return response()->json(['message' => $message], 422);
        } else {
            if ($header == 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IlN1cHRvIEhvc3NlaW4iLCJpYXQiOjE1MTYyMzkwMjJ9.YR0i0vu13icI2ErlYPTBhys95J8fgaaInL71X18nuNU') {
                if ($request->isMethod('delete')) {
                    $data = $request->all();
                    User::whereIn('id', $data['ids'])->delete();
                    $message = 'User deleted';
                    return response()->json(['message' => $message], 200);
                }
            } else {
                $message = 'Authorization does not match';
                return response()->json(['message' => $message], 422);
            }
        }
    }

    // register api using passport
    public function registerUserAPIUsingPassport(Request $request)
    {
        # code...
    }
}
