<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Logincheck extends Authenticatable
{
    use Notifiable;

    protected $table = 'login_details'; // your table name

    protected $fillable = [
        'username',
        'email',
        'password',
        'mobile_no'
    ];

   
}
