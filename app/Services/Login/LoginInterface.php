<?php
namespace App\Services\Login;

interface LoginInterface{
    public function loginstore($data);
    public function logincheck($data);
    public function checkUsernameExist($username);

}