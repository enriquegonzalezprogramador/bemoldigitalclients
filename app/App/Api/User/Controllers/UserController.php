<?php

namespace Desing\Api\User\Controllers;

use Domain\User\Models\User;
use Illuminate\Http\Request;
use Desing\Core\Http\Controllers\Controller;
use Desing\Api\User\Requests\UserRequest;
use Domain\User\DataTransferObjects\UserData;
use Domain\User\Actions\CreateUserAction;
use Domain\User\Actions\UpdateUserAction;

use Illuminate\Support\Facades\DB;

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
    public function store(UserRequest $request, CreateUserAction $action)
    {
        
        try{
            $email = User::where('email', $request->email)->count();

            if ($email === 0)
            {
                $data = UserData::fromRequest($request);
        
               $user = $action($data);

                return response()->json(['message' => 'Successfully registered',
                'id' => $user->id
            ], 200);

            }else {

                return response()->json([
                    'message' => 'Correo electrónico usado',
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
    public function update(UserRequest $request, User $user, UpdateUserAction $action)
    {
        
        try{
            $data = UserData::fromRequest($request);
            $action($data, $user);


            return response()->json([
                'message' => 'Successfully!! user updated..',
                'id' => $user->id
            ], 200);



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
