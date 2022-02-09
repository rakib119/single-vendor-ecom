@extends('dashboard.dashboard')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2>Add Subcategory</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('subcategory.store') }}" method="POST">
                                @csrf
                                <div class="form-group col-6">
                                    <label>Category Name <span class="text-danger">*</span></label>
                                    <select name="category_id"
                                        class="form-control border border-dark  @error('category_id')is-invalid @enderror">
                                        <option value="">--Select Category--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Subcategory Name <span class="text-danger">*</span></label>
                                    <input type="text" name="subcategory_name" value="{{ old('subcategory_name') }}"
                                        class="form-control border border-dark  @error('subcategory_name')is-invalid @enderror">
                                    @error('subcategory_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
