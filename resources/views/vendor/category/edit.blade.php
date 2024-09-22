@extends('layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Category</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Category</h4>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('vendor.category.update', $category->id) }}" method="POST">
                                @csrf
                                @method('POST') <!-- Change to PUT if using resource controller -->
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $category->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description (optional)</label>
                                    <textarea name="description" class="form-control" id="description" rows="4">{{ old('description', $category->description) }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                                <a href="{{ route('vendor.category.list') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
