<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Redirect to the vendor dashboard if the user is already logged in
            return redirect('vendor/dashboard'); // Adjust the route as necessary
        }

        // Return the login view if the user is not authenticated
        return view('auth.login');
    }


    public function login_post(Request $request)
    {
        // dd($request->all());

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if (Auth::User()->is_role == '2') {
                return redirect()->intended('superadmin/dashboard');
            } elseif (Auth::User()->is_role == '1') {
                return redirect()->intended('vendor/dashboard');
            } elseif (Auth::User()->is_role == '0') {
                return redirect()->intended('user/dashboard');
            } else {
                return redirect('login')->with('error', 'No available email found. Please check.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function registration_post(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            // Existing validation rules
            'card_number' => 'credit_card', // Add validation for card number
        ]);

        if ($validator->fails()) {
            return redirect()->route('vendor.register')
            ->withErrors($validator)
                ->withInput();
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'vendor'
        ]);

        // Create the vendor
        Vendor::create([
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'address' => $request->address,
            'slug' => Str::slug($request->input('name')), //add slug
            'phone_number' => $request->phone_number,
            'image_url' => $request->file('image') ? $request->file('image')->store('vendor_images', 'public') : null
        ]);

        // Subscribe the user to a plan
        // $user->newSubscription('default', 'monthly-plan-id')->create($request->card_number);
        return redirect('login')->with('success', 'Registration Successful.');

        // return redirect()->route('vendor.register')->with('success', 'Vendor registered successfully!');
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    // public function forgot_post(Request $request)
    // {
    //     $count = User::where('email', '=', $request->email)->count();
    //     if ($count > 0) {
    //         $user = User::where('email', '=', $request->email)->first();
    //         $user->remember_token = Str::random(50);
    //         $user->save();

    //         Mail::to($user->email)->send(new ForgotPasswordMail($user));
    //         return redirect()->back()->with('success', 'Password has been reset.');
    //     } else {
    //         return redirect()->back()->with('error', 'No available email found. Please check.');
    //     }
    // }

    public function getReset($token)
    {
        // dd($token);
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
            abort(403);
        }

        $user = $user->first();
        $data['token'] = $token;

        return view('auth.reset', $data);
    }

    public function postReset($token, Request $request)
    {
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
            abort(403);
        }

        $user = $user->first();
        $user->password =  bcrypt($request->password);
        $user->remember_token = Str::random(50);
        $user->save();

        return redirect('/')->with('success', 'Password has been updated.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(path: '/'));
    }
}

