<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_id','provider_id','service_id','status','notes'];

    public function client(){
        return $this->belongsTo(User::class , 'client_id');
    }

    public function provider(){
        return $this->belongsTo(User::class , 'provider_id');
    }

    public function service(){
        return $this->belongsTo(Service::class , 'service_id');
    }
}
