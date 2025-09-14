<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table='user_details';
    protected $fillable=['user_id','name','role','email'];

    public function loginmodel(){
        $this->belongsTo(LoginModel::class,'user_id','id');
    }

}
