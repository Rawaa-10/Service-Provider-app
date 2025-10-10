<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Service extends Model
{ 
    use HasFactory;
    protected $casts = [
    'is_active' => 'boolean' ];

    protected $fillable = ['provider_id' , 'category_id' , 
    'title' , 'slug' , 'description', 'price' , 'is_active'];

    public function user(){
        return $this->belongsTo(User::class , "provider_id");
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function favorite_users(){
        return $this->belongsToMany(User::class , 'favorites' ,'user_id', 'service_id');
    }
}
