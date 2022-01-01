@extends('dashboard.dashboard')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Category</a></li>
                </ol>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Add Category</h2>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <h6>{{ session('success') }}</h6>
                        </div>
                    @endif
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-6">
                            <div class="form-group col-12">
                                <label>Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="category_name"
                                    class="form-control border border-dark  @error('category_name')is-invalid @enderror">
                                @error('category_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label>Category Photo <span class="text-danger">*</span></label>
                                <input type="file" accept=".jpg,.png" name="category_photo"
                                    class="form-control border border-dark  @error('category_photo')is-invalid @enderror">
                                @error('category_photo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-primary ml-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
