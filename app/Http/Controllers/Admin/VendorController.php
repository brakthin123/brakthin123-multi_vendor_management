<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function create()
    {
        // $data['getRecord'] = User::find(Auth::user()->id); // Adjust query as needed

        return view('superadmin.vendor.create');
    }
    public function registration_post(Request $request)
    {
        // dd($request->all()); // Uncomment this to debug input data

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'shop_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_role' => 1, // Ensure role is assigned correctly
        ]);

        // Create the vendor
        Vendor::create([
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'image_url' => $request->file('image') ? $request->file('image')->store('vendor_images', 'public') : null,
        ]);

        return redirect()->route('superadmin.vendor.list')->with('success', 'Registration Successful.');
    }


    public function list_vendors(Request $request)
    {
        // Retrieve all users with role 'vendor' and eager-load their vendors
        $data['getRecord'] = User::with('vendors')->where('is_role', 1)->get();

        return view('superadmin.vendor.list', $data);
    }

    public function edit($id)
    {
        // Retrieve the vendor by ID
        $vendor = Vendor::findOrFail($id);
        // dd($vendor);

        // Pass the vendor data to the view
        return view('superadmin.vendor.edit', compact('vendor'));
    }

    public function update_post(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'shop_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);



        // Find the user and vendor
        $user = User::findOrFail($id);
        $vendor = Vendor::where('user_id', $user->id)->first();

        // Update user information
        $user->name = $request->name;
        $user->email = $request->email;

        // If a new password is provided, hash and update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update vendor information
        $vendor->shop_name = $request->shop_name;
        $vendor->address = $request->address;
        $vendor->phone_number = $request->phone_number;

        if ($request->hasFile('image')) {
            // Only delete the old image if it exists and is not empty
            if (!empty($vendor->image_url)) {
                // Ensure image_url is not null before deleting
                Storage::delete($vendor->image_url);
            }

            // Store the new image and update the image_url field
            $vendor->image_url = $request->file('image')->store('vendor_images', 'public');
        }


        $vendor->save();

        return redirect()->route('superadmin.vendor.list')->with('success', 'Update Successful.');
    }




    public function destroy($id)
    {
        // Find the vendor by user ID
        $vendor = Vendor::where('user_id', $id)->first();

        if ($vendor) {
            // Optionally, delete the vendor image if necessary
            if ($vendor->image_url) {
                Storage::delete($vendor->image_url);
            }

            // Delete the vendor
            $vendor->delete();

            // Delete the user
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('superadmin.vendor.list')->with('success', 'Vendor and User deleted successfully.');
        }

        return redirect()->route('superadmin.vendor.list')->with('error', 'Vendor not found.');
    }
}
