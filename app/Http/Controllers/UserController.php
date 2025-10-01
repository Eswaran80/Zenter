<?php

namespace App\Http\Controllers;

use App\Models\Logincheck;
use App\Services\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface=$userInterface;
    }
    public function store(Request $request){

        $validated=Validator::make($request->all(),[
            'username'=>'nullable',
            'role'=>'nullable',
            'email'=>'nullable',
            'password'=>'required',
            'mobile_no'=>'nullable'
        ]);
        $data=$validated->validated();
        $data['password']=Hash::make($data['password']);  
        $userExist=Logincheck::where('username',$data['username'])->exists();
        if(!$userExist){
            Logincheck::create([
            'username'=>$data['username'],
            'role'=>$data['role'],
            'email'=>$data['email'],
            'password'=>$data['password'],
        ]);
         return redirect()->back(); 

        }
        return redirect()->back()->with('error','already exists');  
    }
}
