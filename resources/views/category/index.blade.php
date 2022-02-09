@extends("dashboard.dashboard")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Category List</a></li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header display-flix">
                        <div class="">
                            <h3 class="card-title">Category list</h3>
                        </div>
                        <div class="card-title  d-flex">
                            <h3>
                                <button type="button" class="btn btn-warning mr-1" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    <i class="fa fa-trash mr-1"></i>Recycle Bin
                                </button>
                            </h3>

                            <h3>
                                <a href="{{ route('category.create') }}" class="btn btn-primary  mr-1">
                                    <i class="fa fa-plus mr-1"></i>Add Category
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th class="width50"> #No</th>
                                        <th>Category Name</th>
                                        <th>Category Photo</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td><strong>{{ $loop->index + 1 }}</strong></td>
                                            <td>{{ $category->category_name }}</td>
                                            <td><img src="{{ asset('dashboard\uploads\category_photo') . '/' . $category->category_photo }}"
                                                    width="70" height="50" alt="Category photo"></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge light badge-success">Active</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('category.show', $category->id) }}"
                                                        class="btn btn-success  mr-1"><i class="fa fa-eye  mr-1"></i>Details
                                                    </a>
                                                    <a href="{{ route('category.edit', $category->id) }}"
                                                        class="btn btn-warning text-white mr-1"><i
                                                            class="fa fa-pencil  mr-1"></i>Edit
                                                    </a>
                                                    <form action="{{ route('category.destroy', $category->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
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
                <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
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
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Category Photo</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deleted_category as $deleted_cat)
                                        <tr>
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>{{ $deleted_cat->category_name }}</td>
                                            <td><img src="{{ asset('dashboard\uploads\category_photo') . '/' . $deleted_cat->category_photo }}"
                                                    width="70" height="50" alt="Category photo"></td>
                                            <td>
                                            <td class="d-flex">
                                                <a href="{{ route('category.delete', $deleted_cat->id) }}"
                                                    class="btn btn-sm btn-danger mr-1">Permanent Delete</a>
                                                <a href="{{ route('category.restore', $deleted_cat->id) }}"
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
