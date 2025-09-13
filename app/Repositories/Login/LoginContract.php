<?php

namespace App\Repositories\Login;

interface LoginContract{
    public function loginstore($data);
    public function loginchck($data);
    public function checkUsernameExist($username);

}