<?php

namespace App\Http\Controllers;

use App\Services\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface=$userInterface;
    }
    public function store(Request $request){

        $validated=Validator::make($request->all(),[
            'name'=>'nullable',
            'role'=>'nullable',
            'email'=>'nullable',
        ]);
        $data=$validated->validated();
        $this->userInterface->store($data);
        
    }
}
