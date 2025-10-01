<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\UserDataModel;

class LoginModel extends Model
{
    protected $table='login_details';
    protected $fillable=['username','email','mobile_no','password','role'];
}

