<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Provider\ServiceService;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        $services = $this->serviceService->index();
        return view("Provider.services.index", compact("services"));
    }
    public function create()
    {
        // $services1 = Service::with('user')->get();
        // $services2 = Service::with('category')->get();
        $categories = Category::all();
        return view("Provider.services.create", compact("categories"));
    }
    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        $data['provider_id'] = auth()->user()->id;
        $this->serviceService->create($data);
        $services = $this->serviceService->getAllForProvider(auth()->user()->id);
        return view('Provider.services.index', compact('services'));
    }
    public function show(Service $service)
    {
        $service = $this->serviceService->show($service);
        return view('Provider.services.show', compact('service'));
    }
    /// update process
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->validated();
        $service = $this->serviceService->update($service, $data);
        return redirect()->route('services.show', $service);
    }
    ///edit button 
    public function edit(Service $service)
    {
        $service = $this->serviceService->show($service);
        $categories = Category::all();
        return view('Provider.services.edit', compact('service', 'categories'));
    }

    public function destroy(Service $service)
    {
        try {
            $this->serviceService->destroy($service);
            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');;
        } catch (\Exception $e) {
            return back()->withErrors('Failed to delete service: ' . $e->getMessage());
        }
    }
}
