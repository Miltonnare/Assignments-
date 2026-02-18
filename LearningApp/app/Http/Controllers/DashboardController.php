<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the client dashboard with available services.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Ensure only clients can access this dashboard
        if (!$user->isClient()) {
            abort(403, 'Unauthorized. Only clients can access this dashboard.');
        }

        // Fetch paginated services
        $services = Service::with('freelancer')
            ->latest()
            ->paginate(12);

        return view('dashboard.client', compact('services'));
    }
}
