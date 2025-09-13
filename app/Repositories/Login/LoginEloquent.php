<?php

namespace App\Repositories\Login;

use App\Models\Logincheck;
use Illuminate\Support\Facades\Auth;

use App\Models\LoginModel;
use Illuminate\Support\Facades\Hash;

class LoginEloquent implements LoginContract{
    protected $loginModel;
    protected $logincheck;
    public function __construct(LoginModel $loginModel,Logincheck $loginCheck){
        $this->logincheck=$loginCheck;
        $this->loginModel=$loginModel;
    }

    public function loginstore($data){
        $data['password']=Hash::make($data['password']);
        $userExist=$this->loginModel->where('username',$data['username'])->exists();
        if(!$userExist){
            $this->loginModel->create($data);
        }
        return $userExist;
        }

         public function checkUsernameExist($username){
            return $this->loginModel->where('username',$username)->exists();
        }

        public function loginchck($data)
        {
            // $data['password']=Hash::make($data['password']);
            $logincheck=Auth::attempt(['username'=>$data['username'],'password'=>$data['password']]);
            return $logincheck;
            
        }

       
        
    }
