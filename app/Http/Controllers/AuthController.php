<?php
namespace App\Http\Controllers;
use Validator;
use App\Models\User;
use App\Models\Profile;
use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

       
        try{
            $rules=[
                 'email' => 'required|email',
                 'password' => 'required|string|min:6',
                  ];
                  $validator = Validator::make($request->all(), $rules,[
                    'email.required'=>__('messages.Email is requierd'),
                    'email.email'=>__('messages.Email is Email'),
                    'password.required'=>__('messages.The password is required')
                  ]);
                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }
                if (! $token = auth()->attempt($validator->validated())) {
                    return response()->json(['error' => __('messages.login information is incorrect')], 401);
                }
                $user = Auth::guard('api')->user();

           
              return response()->json([
                'token'=>$token,
                'user'=>$user,
                'message' => __('messages.login Successfully'),
                

             ],200);
            

        }catch (\Exception $ex) {
                return $this->returnError($ex->getCode(), $ex->getMessage());
            } 
        
       
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        
            $rules = [
                'name'         => 'required|string',
                'trade_name'   => 'required|string',
                'email'        => 'required|string|unique:users',
                'password'     => 'required|string|confirmed|min:6',
                'status'       =>'required',
            ];
        
        $validator = Validator::make($request->all(),$rules, [
            'name.required'          =>__('messages.The name is required'),
            'trade_name.required'          =>__('messages.The trade_name is required'),
            'email.required'         =>__('messages.Email is requierd'),
            'email.unique'           =>__('messages.The email has already been taken'),
            'password.required'      =>__('messages.The password is required'),
            'password.confirmed'     =>__('messages.passwordConfirmation is required'),
            'status.required'       =>__('messages.status is required'),
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)],
                
                ));
                $profile = Profile::create([
                    'user_id'=>$user->id,
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'trade_name'=>$user->trade_name,
                    'phone'=>'01000000000',
                    'img'=>'img.png',
                    'address'=>'egypt',
                ]);
               
            
        return response()->json([
            'user' => $user,
            'message' => __('messages.User successfully registered'),
            
        ], 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        $token = $request ->token;
        if($token){
            auth()->logout();
            return response()->json([
         'message' =>   __('messages.You are Logged out')
        ],200);
        }else{
            return response()->json([
                'message' => __('messages.please login'),
            ],400) ;
        }
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
