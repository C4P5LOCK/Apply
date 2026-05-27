<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Http\Resources\ApplicationResource;
use Illuminate\Http\Request;

class ApplicationApiController extends Controller
{
    public function index()
    {
        $applications = Application::latest()->get();

        return response()->json([
            'success' => true,
            'data' => ApplicationResource::collection($applications)
        ]);
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'full_name' => 'required',
        'phone' => 'required',
        'gender' => 'required',
        'dob' => 'required|date',
        'address' => 'required',
        'school' => 'required',
        'qualification' => 'required',
        'cgpa' => 'nullable',
    ]);

    $application = Application::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Application created successfully.',
        'data' => new ApplicationResource($application),
    ], 201);
    }
}