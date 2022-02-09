@extends('dashboard.dashboard')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Banner</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Banner</a></li>
                </ol>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Edit Banner</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('feature.update', $feature->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Feature Name <span class="text-danger">*</span></label>
                                <input type="text" name="feature_name"
                                    class="form-control border border-dark  @error('feature_name')is-invalid @enderror"
                                    value="{{ $feature->feature_name }}">
                                @error('feature_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Feature Message</label>
                                <input type="text" name="feature_message"
                                    class="form-control border border-dark  @error('feature_message')is-invalid @enderror"
                                    value="{{ $feature->feature_message }}">
                                @error('feature_message')
                                    <small class="  text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Feature Photo <span class="text-danger">*</span></label>
                                <input type="file" accept=".jpg,.png" name="feature_photo"
                                    class="form-control border border-dark  @error('feature_photo')is-invalid @enderror">
                                @error('feature_photo')
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
