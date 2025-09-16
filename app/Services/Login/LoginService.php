<?php
namespace App\Services\Login;

use App\Repositories\Login\LoginContract;

class LoginService implements LoginInterface{
protected $loginContract;
   
 public function __construct(LoginContract $loginContract){
        $this->loginContract=$loginContract;
  }
  public function loginstore($data){
   return $this->loginContract->loginstore($data);
   
  }

public function logincheck($data)
{
    return $this->loginContract->loginchck($data);
}

public function checkUsernameExist($username){
    return $this->loginContract->checkUsernameExist($username);
}

}