<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Data\User\StoreUserRequest;
use App\Http\Requests\Data\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allow =  Gate::allows('view-users');
        if (!$allow) {
            return response(['status' => false, 'message' => 'Forbidden'], 403);
        }

        $users = User::all();
        return response()->json(['status' => 'OK', 'data' => compact('users')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = intval($request->user);
        $user = User::find($id);
        if (!$user) {
            return response(['status' => false, 'message' => 'User not found', 'data' => [
                'user' => null
            ]], 404);
        }

        $allow = Gate::allows('view-user', [$user]);
        if (!$allow) {
            return response(['status' => false, 'message' => 'Forbidden'], 403);
        }

        return response(['status' => 'OK', 'data' => [
            'user' => $user
        ]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
