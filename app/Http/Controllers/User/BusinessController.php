<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    /**
     * Show form to create new business
     */
    public function create()
    {
        return view('user.business.create');
    }

    /**
     * Store a new business
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'business_type' => 'required|in:kuliner,fashion,kerajinan,pertanian,perikanan,jasa,perdagangan,lainnya',
            'description' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'required|string',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'postal_code' => 'nullable|string|size:5',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'established_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'employee_count' => 'nullable|integer|min:1',
            'business_scale' => 'required|in:mikro,kecil,menengah',
            'monthly_revenue' => 'nullable|numeric|min:0',
            'main_product' => 'nullable|string|max:255',
            'nib' => 'nullable|string|max:50',
            'siup' => 'nullable|string|max:50',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create business
        $business = Business::create([
            'user_id' => auth()->id(),
            'business_name' => $request->business_name,
            'owner_name' => $request->owner_name,
            'business_type' => $request->business_type,
            'description' => $request->description,
            'phone' => $request->phone,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'address' => $request->address,
            'village' => $request->village,
            'district' => $request->district,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'established_year' => $request->established_year,
            'employee_count' => $request->employee_count ?? 1,
            'business_scale' => $request->business_scale,
            'monthly_revenue' => $request->monthly_revenue,
            'main_product' => $request->main_product,
            'nib' => $request->nib,
            'pirt' => $request->pirt,
            'halal_certificate' => $request->halal_certificate,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'website' => $request->website,
            'status' => 'pending',
        ]);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('business-photos', 'public');
                
                BusinessPhoto::create([
                    'business_id' => $business->id,
                    'photo_path' => $path,
                    'photo_type' => $request->photo_types[$index] ?? 'produk',
                    'caption' => $request->photo_captions[$index] ?? null,
                    'order' => $index,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()->route('user.dashboard')
            ->with('success', 'Data usaha berhasil ditambahkan dan menunggu persetujuan admin.');
    }

    /**
     * Show business details
     */
    public function show($id)
    {
        $business = Business::with(['photos', 'approver'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.business.show', compact('business'));
    }

    /**
     * Show form to edit business
     */
    public function edit($id)
    {
        $business = Business::with('photos')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.business.edit', compact('business'));
    }

    /**
     * Update business
     */
    public function update(Request $request, $id)
    {
        $business = Business::where('user_id', auth()->id())->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'business_type' => 'required|in:kuliner,fashion,kerajinan,pertanian,perikanan,jasa,perdagangan,lainnya',
            'description' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'required|string',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'postal_code' => 'nullable|string|size:5',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'established_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'employee_count' => 'nullable|integer|min:1',
            'business_scale' => 'required|in:mikro,kecil,menengah',
            'monthly_revenue' => 'nullable|numeric|min:0',
            'main_product' => 'nullable|string|max:255',
            'nib' => 'nullable|string|max:50',
            'pirt' => 'nullable|string|max:50',
            'halal_certificate' => 'nullable|string|max:50',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'new_photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update business
        $business->update($request->except(['new_photos', 'photo_types', 'photo_captions', 'delete_photos']));

        // Handle photo deletions
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = BusinessPhoto::where('business_id', $business->id)->find($photoId);
                if ($photo) {
                    // Delete file from storage
                    if (Storage::disk('public')->exists($photo->photo_path)) {
                        Storage::disk('public')->delete($photo->photo_path);
                    }
                    $photo->delete();
                }
            }
        }

        // Handle new photo uploads
        if ($request->hasFile('new_photos')) {
            $currentPhotoCount = $business->photos()->count();
            
            foreach ($request->file('new_photos') as $index => $photo) {
                $path = $photo->store('business-photos', 'public');
                
                BusinessPhoto::create([
                    'business_id' => $business->id,
                    'photo_path' => $path,
                    'photo_type' => $request->photo_types[$index] ?? 'produk',
                    'caption' => $request->photo_captions[$index] ?? null,
                    'order' => $currentPhotoCount + $index,
                    'is_primary' => $currentPhotoCount === 0 && $index === 0,
                ]);
            }
        }

        // Reset status to pending if it was rejected
        if ($business->status === 'rejected') {
            $business->update(['status' => 'pending', 'rejection_reason' => null]);
        }

        return redirect()->route('user.business.show', $business->id)
            ->with('success', 'Data usaha berhasil diperbarui.');
    }

    /**
     * Delete business
     */
    public function destroy($id)
    {
        $business = Business::where('user_id', auth()->id())->findOrFail($id);
        $business->delete();

        return redirect()->route('user.dashboard')
            ->with('success', 'Data usaha berhasil dihapus.');
    }
}
