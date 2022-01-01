@extends("dashboard.dashboard")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Category</a></li>
                </ol>
            </div>
            <div class="card-header">
                <h5 class="card-title">Edit Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data" method="POST">
                    @method('patch')
                    @csrf
                    <div class="col-6">
                        <div class="form-group col-12">
                            <label>Category Name <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $category->category_name }}" name="category_name"
                                class="form-control  border border-dark @error('category_name')is-invalid @enderror">
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
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
