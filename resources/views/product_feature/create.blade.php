@extends('dashboard.dashboard')
{{-- javascript --}}
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Feature Photo</a></li>
                </ol>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Add Feature Photo <span style="font-size: 15px;"> <a class="text-primary"
                                href=" {{ route('product.show', $product->id) }}">of {{ $product->product_name }}</a>
                        </span>
                    </h2>
                    <a href="{{ route('product.show', $product->id) }}"><img
                            src="{{ asset('uploads\products') . '/' . $product->product_photo }}" width="50"
                            alt="product photo"></a>
                </div>
                <div class="card-body">
                    <form action="{{ route('feature_photo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Photos <span class="text-danger">*</span></label>
                                <input type="hidden" value="{{ $product->slug }}" name="slug">
                                <input type="file" accept=".jpg,.jpeg" name="photo_name[]" multiple
                                    class="form-control border border-dark  @error('photo_name')is-invalid @enderror">
                                @error('photo_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
