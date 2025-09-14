<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;

class LoginModel extends Model
{
    protected $table='login_details';
    protected $fillable=['username','email','mobile_no','password',];

     public function UserModel(){
        $this->hasOne(UserModel::class,'user_id','id');
    }
}

