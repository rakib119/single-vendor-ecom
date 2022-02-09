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
                    <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Banner Message <span class="text-danger">*</span></label>
                                <input type="text" name="banner_message"
                                    class="form-control border border-dark  @error('banner_message')is-invalid @enderror"
                                    value="{{ $banner->banner_message }}">
                                @error('banner_message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Offer Message</label>
                                <input type="text" name="offer_message"
                                    class="form-control border border-dark  @error('offer_message')is-invalid @enderror"
                                    value="{{ $banner->offer_message }}">
                                @error('offer_message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Banner Photo <span class="text-danger">*</span></label>
                                <input type="file" accept=".jpg,.png" name="banner_photo"
                                    class="form-control border border-dark  @error('banner_photo')is-invalid @enderror">
                                @error('banner_photo')
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
