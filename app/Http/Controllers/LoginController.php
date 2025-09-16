<?php

namespace App\Http\Controllers;

use App\Services\Login\LoginInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $loginInterface;
    public function __construct(LoginInterface $loginInterface)
    {
        $this->loginInterface=$loginInterface;
    }


   public function loginshow(){
        return view('login-page');
    }
    public function registershow(){
        return view('register-page');
    }
    public function dashboardshow(){
        return view('dashboard');
    }

    public function loginstore(Request $request){
    try{
          $validate=Validator::make($request->all(),[
            'username'=>'required|min:5',
            'email'=>'required|email',
            'mobile_no'=>'nullable|min:10|max:10',
            'password'=>'required|min:6'
        ]);
        if($validate->fails()){
            // return response()->json([
            //     'status'=>false,
            //     'error'=>$validate->errors()
            // ],422);
            return redirect()->route('register.show')->with('error',$validate->errors()->first());

        }
        
        $data=$validate->validated();   
        
       $exist=$this->loginInterface->loginstore($data);
       if($exist){
            return redirect()->route('register.show')->with('error','Username already exists');
            // return response()->json(['error'=>'already exist']);
       }
       return redirect()->route('login');
    }
    
    catch(\Exception $e){
        return response()->json([
            'error'=>'an error occured',$e->getMessage()
        ],500);
    }
    
    }

    public function logincheck(Request $request){
        
         $validate=Validator::make($request->all(),[
            'username'=>'required|min:5',
            'password'=>'required|min:6'
        ]);
        $data=$validate->validated();
        $username=$data['username'];
        $checkUsernameExist=$this->loginInterface->checkUsernameExist($username);
        if($checkUsernameExist){
             $iscorrect=$this->loginInterface->logincheck($data);
            if(!$iscorrect){
                     return redirect()->route('login')->with('error','Password is incorrect');
                }
                $request->session()->regenerate();
                 return redirect()->route('dashboard.show');
        }
        return redirect()->route('login')->with('error','User does not exist please register first!');
    }
   public function logout(Request $request)
{
    Auth::logout();

    // Invalidate session
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}

    public function usershow(){
        return view('users');
    }
}