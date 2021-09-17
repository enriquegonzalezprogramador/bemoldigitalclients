<?php

namespace Desing\Api\Auth\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Mail\ForgotPassword;
use Domain\User\Models\User;
use Mail;
use Illuminate\Support\Str;
use Desing\Core\Http\Controllers\Controller;

use Desing\Api\User\Requests\UserRequest;
use Domain\User\DataTransferObjects\UserData;
use Domain\User\Actions\CreateUserAction;

use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'loginApp', 'register', 'forgotPassword']]);
    }

    /**
     * Registe a new user via.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request, CreateUserAction $action)
    {
        
        try{
            $email = User::where('email', $request->email)->count();

            if ($email === 0)
            {
                        $data = UserData::fromRequest($request);
        
                        $action($data);
        
                        return response()->json(['message' => 'Successfully registered'], 200);
                
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
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

  
        $user = User::where('email', $credentials['email'])->first();
		//return dd($user);
        try{
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            if ($user->type === 'Mobile') {
                return response()->json(['error' => 'Unauthorized'], 401);
            }	
            
            

            return $this->respondWithToken($token);
        }catch(\Exception $e){
dd('Error');
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function loginApp()
    {
        $credentials = request(['email', 'password']);

        $user = User::where('email', request('email'))->with('people', 'people.peopleTypes', 'people.constructions', 'people.constructions.department', 'people.constructions.province', 'people.constructions.district', 'people.planifications', 'people.constructions.planifications', 'people.planifications.peoples', 'people.planifications.peoples.peopleTypes', 'people.planifications.protocol', 'people.planifications.protocol.observations', 'people.planifications.protocol.observations.observation_type', 'people.planifications.protocol.observations.evaluations', 'people.planifications.protocol.observations.evaluations.options')->first();

        $peoples = People::where('enterprise_id', '!=', 1)->get();

        $peopleTypes = PeopleType::get();

        $enterprises = Enterprise::where('id', '!=', 1)->get();

        $departments = Department::get();

        try{
            if ((!$token = auth()->attempt($credentials)) || $user->people->status === 'Pendiente') {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'user' => $user,
                'peopleTypes' => $peopleTypes,
                'enterprises' => $enterprises,
                'peoples' => $peoples,
                'departments' => $departments,
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }

    public function forgotPassword(Request $request, $email)
    {
        try{
            $user = User::where('email', $request->email)->first();
            $newPassword = Str::random(10);

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user->update([
                'password' => bcrypt($newPassword)
            ]);

            Mail::to($user->email)->send(new ForgotPassword($newPassword));

            return response()->json([
                'message' => 'Contraseña enviada',
                'user' => $newPassword
            ]);

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
