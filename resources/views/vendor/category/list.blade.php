@extends('layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Categories</h3>
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
                        <a href="#">Categories</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between;">
                            <h4 class="card-title">Category List</h4>
                            <a href="{{ route('vendor.category.create') }}" class="btn btn-primary btn-round">Add
                                Category</a>
                        </div>
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="categories-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <span class="short-description-{{ $category->id }}">
                                                        {{ \Illuminate\Support\Str::words($category->description, 15, '...') }}
                                                    </span>
                                                    <span class="full-description-{{ $category->id }}"
                                                        style="display:none;">
                                                        {{ $category->description }}
                                                    </span>
                                                    <a href="javascript:void(0)" class="toggle-description"
                                                        data-id="{{ $category->id }}" style="color:blue;">
                                                        See more
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('vendor.category.edit', $category->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('vendor.category.destroy', $category->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
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
            $('#categories-datatables').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-description').forEach(function(toggleLink) {
                toggleLink.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var shortDesc = document.querySelector('.short-description-' + id);
                    var fullDesc = document.querySelector('.full-description-' + id);

                    if (shortDesc.style.display === 'none') {
                        shortDesc.style.display = 'inline';
                        fullDesc.style.display = 'none';
                        this.innerHTML = 'See more';
                    } else {
                        shortDesc.style.display = 'none';
                        fullDesc.style.display = 'inline';
                        this.innerHTML = 'See less';
                    }
                });
            });
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@endsection
