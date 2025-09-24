<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserDataModel;

class TasksModel extends Model
{
    protected $table='tasks_details';
    protected $fillable=['user_id','task_title','task','status'];

    public function userData(){
        return $this->belongsTo(UserDataModel::class);
    }
}
