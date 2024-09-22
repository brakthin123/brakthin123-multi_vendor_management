<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data = [];

        if (Auth::check()) { // Check if user is authenticated
            switch (Auth::user()->is_role) {
                case 2:
                    $data['getRecord'] = User::find(Auth::user()->id);
                    return view('superadmin.dashboard', $data);
                case 1:
                    // $data['getRecord'] = User::find(Auth::user()->id);
                    return view('vendor.dashboard');
                case 0:
                    return view('user.dashboard');
            }
        }

        // Redirect to login if not authenticated
        return redirect('/login');
    }
}
