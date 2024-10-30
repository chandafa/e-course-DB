<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('administrator')) {
            return response()->json(['message' => 'Welcome, Admin!']);
        } elseif ($user->hasRole('mentor')) {
            return response()->json(['message' => 'Welcome, Mentor!']);
        } elseif ($user->hasRole('customer')) {
            return response()->json(['message' => 'Welcome, Customer!']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}