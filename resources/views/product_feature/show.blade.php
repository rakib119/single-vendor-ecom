@extends('dashboard.dashboard')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Feature Photo List</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <div>
                                <a class="text-primary mr-5"
                                    href=" {{ route('product.show', $feature_photo->product_id) }}">
                                    <h4> {{ $feature_photo->product_name }}</h4>

                                </a>
                            </div>
                            <div class="d-flex">
                                <a class="btn btn-primary mx-3"
                                    href="{{ route('feature_photo.create', 'pid=' . $feature_photo->slug) }}"><i
                                        class="fa fa-plus mr-1"></i>Add Feature
                                    Photo</a>
                                <a href="{{ route('product.index') }}" class=" btn btn-info mx-3"><i
                                        class="fa fa-arrow-left mr-1"></i> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th class="width50"> #No</th>
                                            <th>Product Name</th>
                                            <th>Product Photo</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($feature_photos as $feature_photo)

                                            <tr>
                                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                                <td>{{ $feature_photo->product_name }}</td>
                                                <td><img src="{{ asset('uploads\product_feature_photo') . '/' . $feature_photo->photo_name }}"
                                                        width="50" alt="product photo"></td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <form id="deleteItem"
                                                            action="{{ route('feature_photo.destroy', $feature_photo->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="javascript:void(0)" onclick="deleteItem()"
                                                                class="btn btn-danger"><i
                                                                    class="fa fa-trash  mr-1"></i>Delete</a>
                                                        </form>
                                                        <a href="{{ route('feature_photo.edit', $feature_photo->id) }}"
                                                            class="btn btn-warning ml-3 text-white mr-1"><i
                                                                class="fa fa-pencil  mr-1"></i>Edit
                                                        </a>

                                                    </div>
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
@endsection
