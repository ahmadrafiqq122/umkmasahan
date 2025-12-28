<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API untuk map - Get all approved businesses
Route::get('/businesses', function () {
    return \App\Models\Business::where('status', 'approved')
        ->select('id', 'business_name', 'address', 'business_type', 'latitude', 'longitude')
        ->get();
});
