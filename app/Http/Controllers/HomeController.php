<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show homepage with map
     */
    public function index()
    {
        // Get all approved businesses for public view
        $businesses = Business::with(['primaryPhoto', 'user'])
            ->approved()
            ->get();

        // Get statistics
        $stats = [
            'total_businesses' => Business::approved()->count(),
            'districts' => Business::approved()->distinct('district')->count('district'),
            'business_types' => Business::approved()->distinct('business_type')->count('business_type'),
        ];

        return view('home', compact('businesses', 'stats'));
    }

    /**
     * Get business details for popup
     */
    public function getBusinessDetail($id)
    {
        $business = Business::with(['photos', 'user'])
            ->approved()
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'business' => $business,
        ]);
    }

    /**
     * Search businesses
     */
    public function search(Request $request)
    {
        $query = Business::with(['primaryPhoto', 'user'])->approved();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('business_name', 'like', "%{$keyword}%")
                  ->orWhere('owner_name', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('business_type', $request->type);
        }

        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        $businesses = $query->get();

        return response()->json([
            'success' => true,
            'businesses' => $businesses,
        ]);
    }
}
