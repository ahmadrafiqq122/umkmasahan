<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        // General statistics
        $stats = [
            'total_businesses' => Business::count(),
            'approved' => Business::where('status', 'approved')->count(),
            'pending' => Business::where('status', 'pending')->count(),
            'rejected' => Business::where('status', 'rejected')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'districts' => Business::where('status', 'approved')->distinct('district')->count('district'),
        ];

        // Businesses by type (for chart)
        $businessesByType = Business::where('status', 'approved')
            ->select('business_type', DB::raw('count(*) as total'))
            ->groupBy('business_type')
            ->get();
        
        $business_by_type = [];
        foreach ($businessesByType as $item) {
            $business_by_type[$item->business_type] = $item->total;
        }

        // Businesses by district (for chart)
        $businessesByDistrict = Business::where('status', 'approved')
            ->select('district', DB::raw('count(*) as total'))
            ->groupBy('district')
            ->orderBy('total', 'desc')
            ->get();
        
        $business_by_district = [];
        foreach ($businessesByDistrict as $item) {
            $business_by_district[$item->district] = $item->total;
        }

        // Recent businesses
        $recent_businesses = Business::with(['user'])
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'business_by_type',
            'business_by_district',
            'recent_businesses'
        ));
    }
}
