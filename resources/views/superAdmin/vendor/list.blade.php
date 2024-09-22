@extends('layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Vendors</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Tables</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Vendors</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between;">
                            <h4 class="card-title">Vendor List</h4>
                            <a href="{{ url('superadmin/vendor/create') }}" class="btn btn-primary btn-round">Add Vendor</a>
                        </div>
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="vendors-datatables" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="vendors-datatables_info">
                                    <thead>
                                        <tr role="row">
                                            <th>Name</th>
                                            <th>Shop Name</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $user)
                                            @foreach ($user->vendors as $vendor)
                                                <tr role="row" class="odd">
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $vendor->shop_name }}</td>
                                                    <td>{{ $vendor->address }}</td>
                                                    <td>{{ $vendor->phone_number }}</td>
                                                    <td>
                                                        @if ($vendor->image_url)
                                                            <img src="{{ asset('storage/' . $vendor->image_url) }}" alt="{{ $vendor->shop_name }}" width="50" height="50" class="img-fluid rounded">
                                                        @else
                                                            No Image
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                            <form action="{{ route('vendor.destroy', $vendor->user_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vendor?');" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and DataTables scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#vendors-datatables').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endsection

@if (Session::has('success'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
            "timeOut": 12000,
        }
        toastr.success("{{ Session::get('success') }}", 'Success!');
    </script>
@endif

@if (Session::has('error'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
            "timeOut": 12000,
        }
        toastr.error("{{ Session::get('error') }}", 'Error!');
    </script>
@endif

@if (Session::has('info'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
            "timeOut": 12000,
        }
        toastr.info("{{ Session::get('info') }}", 'Info!');
    </script>
@endif

@if (Session::has('warning'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
            "timeOut": 12000,
        }
        toastr.warning("{{ Session::get('warning') }}", 'Warning!');
    </script>
@endif

<!-- Include DataTables CSS -->
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@endsection
