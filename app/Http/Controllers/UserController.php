<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use App\Services\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

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
        UserModel::create([
            'user_id'=>Auth::user()->id,
            'name'=>$data['name'],
            'role'=>$data['role'],
            'email'=>$data['email']
        ]);
        return redirect()->back();  
    }
}
