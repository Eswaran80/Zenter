<?php

namespace App\Services\User;

use App\Repositories\User\UserContract;

class UserService implements UserInterface{
    protected $userContract;
    public function __construct(UserContract $userContract)
    {
        $this->userContract=$userContract;
    }

    public function store($data){
        $this->userContract->store($data);
    }

}