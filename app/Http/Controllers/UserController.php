<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        return response()->json([
            'users' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $email = User::where('email', $request->email)->count();

            if ($email === 0)
            {
                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'type' => $request->type,
                    'confirmed' => true,
                ]);

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $user->id
                ], 200);

            }else {

                return response()->json([
                    'message' => 'Correo electrónico usado'
                ], 226);

            }

        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'user' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try{

            $user->update([
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'message' => 'Successfully',
                'id' => $user->id
            ], 200);

            /* if ($email === 0)
            {
                $requestData = $request->all();

                if ($request->has('password')) {
                    $requestData['password'] = bcrypt($requestData['password']);
                }

                $user->update($requestData);



            }else {

                return response()->json([
                    'message' => 'Correo electrónico usado'
                ], 226);

            } */

        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
