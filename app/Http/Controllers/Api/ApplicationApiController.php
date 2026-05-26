<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Http\Resources\ApplicationResource;

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
}