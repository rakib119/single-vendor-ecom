@extends("dashboard.dashboard")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Product List</a></li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header display-flix">
                        <div class="">
                            <h3 class="card-title">Product List</h3>
                        </div>
                        <div class="card-title  d-flex">
                            <h3>
                                <button type="button" class="btn btn-warning mr-1" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    <i class="fa fa-trash mr-1"></i>Recycle Bin
                                </button>
                            </h3>
                            <h3>
                                <a href="{{ route('product.create') }}" class="btn btn-primary  mr-1">
                                    <i class="fa fa-plus mr-1"></i>Add Product
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                <h6>{{ Str::ucfirst(session('success')) }}</h6>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th class="width50"> #No</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Photo</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td><strong>{{ $loop->index + 1 }}</strong></td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->discounted_price }}</td>
                                            <td><img src="{{ asset('uploads\products') . '/' . $product->product_photo }}"
                                                    width="70" height="50" alt="product photo"></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('product.show', $product->id) }}"
                                                        class="btn btn-primary text-white mr-1"><i
                                                            class="fa fa-info mr-1"></i> View
                                                    </a>
                                                    <a href="{{ route('product.edit', $product->id) }}"
                                                        class="btn btn-warning text-white mr-1"><i
                                                            class="fa fa-pencil  mr-1"></i>Edit
                                                    </a>
                                                    <form action="{{ route('product.destroy', $product->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fa fa-trash  mr-1"></i>Delete</button>
                                                    </form>
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
            <div class="modal fade" id="exampleModalCenter">
                <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <i class="fa fa-trash mr-1"></i>Recycle Bin</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#No</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Photo</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deleted_products as $deleted_product)
                                        <tr>
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>{{ $deleted_product->product_name }}</td>
                                            <td>{{ $deleted_product->discounted_price }}</td>
                                            <td><img src="{{ asset('uploads\products') . '/' . $deleted_product->product_photo }}"
                                                    width="70" height="50" alt="product photo"></td>
                                            <td class="d-flex justify-content-center">
                                                <form action="{{ route('product.delete', $deleted_product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-trash  mr-1"></i>Permanent Delete</button>
                                                </form>
                                                <a href="{{ route('product.restore', $deleted_product->id) }}"
                                                    class="btn btn-sm btn-success ml-1">Restore</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection