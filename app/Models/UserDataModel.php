<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LoginModel;
use App\Models\TasksModel;

class UserDataModel extends Model
{
    protected $table='users_personal_data';
    protected $fillable=['user_id','name','description','gender','dob','location'];

}
