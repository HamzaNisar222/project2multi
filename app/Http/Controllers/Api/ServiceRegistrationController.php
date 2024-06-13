<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorServiceRegistration;
use App\Http\Requests\VendorServiceRequest;

class ServiceRegistrationController extends Controller
{
    public function index() {}

    public function create(VendorServiceRequest $request) {
        $documentPath = $request->file('document_path')->store('documents');

        $vendorServiceRegistration = VendorServiceRegistration::create([
            'vendor_id' => $request->user->id,
            'service_id' => $request->service_id,
            'document_path' => $documentPath,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Service Registration submit Successfully'
        ], 201);
    }
}
