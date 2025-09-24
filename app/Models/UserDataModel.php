<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LoginModel;
use App\Models\TasksModel;

class UserDataModel extends Model
{
    protected $table='users_data';
    protected $fillable=['user_id','name','description','gender','dob','location'];

    public function logindetails(){
        return $this->belongsTo(LoginModel::class);
    }
    public function taskDetails(){
        return $this->hasMany(TasksModel::class);
    }
}
