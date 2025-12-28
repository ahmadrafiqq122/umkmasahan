<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show user dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        $businesses = Business::where('user_id', $user->id)
            ->withCount('photos')
            ->latest()
            ->get();

        $stats = [
            'total' => $businesses->count(),
            'approved' => $businesses->where('status', 'approved')->count(),
            'pending' => $businesses->where('status', 'pending')->count(),
            'rejected' => $businesses->where('status', 'rejected')->count(),
        ];

        return view('user.dashboard', compact('businesses', 'stats'));
    }
}
