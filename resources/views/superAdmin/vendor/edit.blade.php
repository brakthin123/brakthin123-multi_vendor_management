@extends('layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Vendor & User</h3>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Vendor & User Details</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form to edit vendor and user -->
                            <form action="{{ route('vendor.update', $vendor->user_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf <!-- Use PUT method for update -->

                                <!-- User Details -->
                                <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $vendor->user->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">User Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $vendor->user->email) }}" required>
                                </div>

                                <!-- Vendor Details -->
                                <div class="form-group">
                                    <label for="shop_name">Shop Name</label>
                                    <input type="text" class="form-control" id="shop_name" name="shop_name"
                                        value="{{ old('shop_name', $vendor->shop_name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address', $vendor->address) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $vendor->phone_number) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Vendor Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if ($vendor->image_url)
                                        <img src="{{ asset('storage/' . $vendor->image_url) }}" alt="Vendor Image"
                                            style="width: 100px;">
                                    @else
                                        <p>No image uploaded.</p> <!-- Message when there's no image -->
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-success">Update Vendor & User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
