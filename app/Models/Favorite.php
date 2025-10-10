<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable =['user_id', 'service_id'];

    public function user(){
        return $this->belongsToMany(User::class,'favorites','user_id');
    }

    public function service(){
        return $this->belongsToMany(Service::class,'favorites','service_id');
    }
}
