<?php

namespace App\Http\Services\Provider;

use Illuminate\Database\Eloquent\Collection;
Use App\Models\Service;
class ServiceService{
    
    public function index(){
        return Service::with('user','category')->paginate(10);
    }
    public function create(array $data)
    {
        return Service::create($data);
    }

    public function show(Service $service)
    {
        return $service->load(['category' , 'user']); 
    }
    public function getAllForProvider($providerId)
    {
        return Service::where('provider_id', $providerId)->get();
    }
    public function update(Service $service , array $data){
        return $service->update($data);
    }
    public function destroy(Service $service){
        return $service->delete();
    }
}