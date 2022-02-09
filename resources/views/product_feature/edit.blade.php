@extends('dashboard.dashboard')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                    <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Feature Photo List</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Feature Photo</a></li>
                </ol>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Edit Feature Photo <span style="font-size: 15px;"> <a class="text-primary"
                                href=" {{ route('product.show', $featurePhoto->product_id) }}">of <img
                                    src="{{ asset('uploads\product_feature_photo') . '/' . $featurePhoto->photo_name }}"
                                    width="50" alt="feature photo"></a>
                        </span></h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('feature_photo.update', $featurePhoto->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Photos <span class="text-danger">*</span></label>
                                <input type="file" accept=".jpg,.jpeg" name="photo_name"
                                    class="form-control border border-dark @error('photo_name')is-invalid @enderror">
                                @error('photo_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
