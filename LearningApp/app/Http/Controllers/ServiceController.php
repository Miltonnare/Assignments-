<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(Request $request)
    {
        $services = Service::with('freelancer')
            ->latest()
            ->paginate(15);

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $this->authorize('create', Service::class);
        
        return view('services.create');
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Service::class);

        $service = Service::create([
            'user_id' => $request->user()->id,
            ...$request->validated(),
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service created successfully');
    }

    /**
     * Display the specified service.
     */
    public function show(Service $service)
    {
        $service->load('freelancer');

        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        $this->authorize('update', $service);

        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(UpdateRequest $request, Service $service)
    {
        $this->authorize('update', $service);

        $service->update($request->validated());

        return redirect()
            ->route('services.index')
            ->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Request $request, Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Service deleted successfully');
    }
}
