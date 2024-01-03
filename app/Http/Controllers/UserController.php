<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // make a new user
    public function create(UserRequest $request)
    {
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'access_level' => $request->access_level,
        ]);
        return UserResource::make($user);
    }

    // get all users with specific access level
    public function index(Request $request)
    {
        // get all users with specific access level
        if ($request->has('access_level')) {
            // Retrieve users with the specified access level
            $users = User::where('access_level', $request->input('access_level'))->get();
        } else {
            // If 'access_level' is not provided, retrieve all users
            $users = User::all();
        }
        // return the users
        return UserResource::collection($users);
    }


    // get a single user
    public function show(User $user)
    {
        // return the user
        return UserResource::make($user);
    }

    // show auth user
    public function showAuth()
    {
        // get the user
        $user = auth()->user();

        // return the user
        return UserResource::make($user);
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->except('password'));

        return UserResource::make($user);
    }

    // delete a user
    public function delete(User $user)
    {

        // delete the user
        $user->delete();

        // return the user
        return UserResource::make($user);
    }

    // login a user
    public function login(Request $request)
    {
        $user = User::where(['username' => $request->username])->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('token', [$user->access_level])->plainTextToken;
            return UserResource::make($user)->additional(['token' => $token]);
        } return response()->json(['message' => 'wrong credential'], 401);

    }

    // logout a user
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()
            ->json(['message' => 'you successfully logged out'], 200);

    }

}
