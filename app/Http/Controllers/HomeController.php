<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    // Returning to dashboard
    public function dashboard(Request $request)
    {
        if ($request->ajax()) {

            return response()->json(['message' => 'Successfull response!'], 200);
        }

        return view('dashboard');
    }
}