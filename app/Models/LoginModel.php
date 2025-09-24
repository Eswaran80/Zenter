<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\UserDataModel;

class LoginModel extends Model
{
    protected $table='login_details';
    protected $fillable=['username','email','mobile_no','password',];

     public function userModel(){
        $this->hasOne(UserModel::class,'user_id','id');
    }

    public function userDate(){
        return $this->hasMany(UserDataModel::class);
    }
}

