<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    /**
     * Display a listing of businesses
     */
    public function index(Request $request)
    {
        $query = Business::with(['user', 'primaryPhoto']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by business type
        if ($request->filled('type')) {
            $query->where('business_type', $request->type);
        }

        // Filter by district
        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                  ->orWhere('owner_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('email', 'like', "%{$search}%");
                  });
            });
        }

        $businesses = $query->latest()->paginate(20);

        return view('admin.businesses.index', compact('businesses'));
    }

    /**
     * Show business details
     */
    public function show($id)
    {
        $business = Business::with(['user', 'photos', 'approver'])->findOrFail($id);
        return view('admin.businesses.show', compact('business'));
    }

    /**
     * Approve a business
     */
    public function approve($id)
    {
        $business = Business::findOrFail($id);
        $business->approve(auth()->id());

        return back()->with('success', 'Usaha berhasil disetujui.');
    }

    /**
     * Show reject form
     */
    public function rejectForm($id)
    {
        $business = Business::with(['user', 'photos'])->findOrFail($id);
        return view('admin.businesses.reject', compact('business'));
    }

    /**
     * Reject a business
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|min:10',
        ], [
            'rejection_reason.required' => 'Alasan penolakan wajib diisi.',
            'rejection_reason.min' => 'Alasan penolakan minimal 10 karakter.',
        ]);

        $business = Business::findOrFail($id);
        $business->reject($request->rejection_reason);

        return redirect()->route('admin.businesses.index')
            ->with('success', 'Usaha berhasil ditolak.');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $business = Business::with('photos')->findOrFail($id);
        return view('admin.businesses.edit', compact('business'));
    }

    /**
     * Update business
     */
    public function update(Request $request, $id)
    {
        $business = Business::findOrFail($id);

        $request->validate([
            'business_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'business_type' => 'required|in:kuliner,fashion,kerajinan,pertanian,perikanan,jasa,perdagangan,lainnya',
            'description' => 'required|string',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $business->update($request->all());

        return redirect()->route('admin.businesses.show', $business->id)
            ->with('success', 'Data usaha berhasil diperbarui.');
    }

    /**
     * Delete business
     */
    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();

        return redirect()->route('admin.businesses.index')
            ->with('success', 'Data usaha berhasil dihapus.');
    }

    /**
     * Bulk approve businesses
     */
    public function bulkApprove(Request $request)
    {
        $request->validate([
            'business_ids' => 'required|array',
            'business_ids.*' => 'exists:businesses,id',
        ]);

        foreach ($request->business_ids as $id) {
            $business = Business::find($id);
            if ($business && $business->isPending()) {
                $business->approve(auth()->id());
            }
        }

        return back()->with('success', count($request->business_ids) . ' usaha berhasil disetujui.');
    }

    /**
     * Bulk delete businesses
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'business_ids' => 'required|array',
            'business_ids.*' => 'exists:businesses,id',
        ]);

        Business::whereIn('id', $request->business_ids)->delete();

        return back()->with('success', count($request->business_ids) . ' usaha berhasil dihapus.');
    }

    /**
     * Delete photo
     */
    public function deletePhoto($businessId, $photoId)
    {
        $photo = BusinessPhoto::where('business_id', $businessId)->findOrFail($photoId);
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
