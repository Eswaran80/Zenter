<?php
namespace App\Repositories\User;

use App\Models\UserModel;
use App\Models\LoginModel;

class UserEloquent implements UserContract{
    protected $userModel;
    protected $loginModel;
    public function __construct(UserModel $userModel,LoginModel $loginModel)
    {
        $this->userModel=$userModel;
        $this->loginModel=$loginModel;
        
    }
    public function store($data){
        $this->userModel->create($data);
    }
}