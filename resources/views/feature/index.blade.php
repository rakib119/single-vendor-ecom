@extends("dashboard.dashboard")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('feature.index') }}">Features</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Features List</a></li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header display-flix">
                        <div class="">
                            <h3 class="card-title">Features list</h3>
                        </div>
                        <div class="card-title  d-flex">
                            <h3>
                                <button type="button" class="btn btn-warning mr-1" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    <i class="fa fa-trash mr-1"></i>Recycle Bin
                                </button>
                            </h3>
                            <h3>
                                <a href="{{ route('feature.create') }}" class="btn btn-primary  mr-1">
                                    <i class="fa fa-plus mr-1"></i>Add Features
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
                                        <th>Feature Name</th>
                                        <th>Feature Message </th>
                                        <th>Feature Photo</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($features as $feature)
                                        <tr>
                                            <td><strong>{{ $loop->index + 1 }}</strong></td>
                                            <td>{{ $feature->feature_name }}</td>
                                            <td>{{ $feature->feature_message }}</td>
                                            <td><img src="{{ asset('uploads\feature') . '/' . $feature->feature_photo }}"
                                                style="background: linear-gradient(-155deg, #fd3d6b 0%, #fd7863 98%, #f3dfe0 100%); width:70px; height:70px;" alt="features photo"></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('feature.edit', $feature->id) }}"
                                                        class="btn btn-warning text-white mr-1"><i
                                                            class="fa fa-pencil  mr-1"></i>Edit
                                                    </a>
                                                    <form action="{{ route('feature.destroy', $feature->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $feature->id }}">
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
                                        <th>#No</th>
                                        <th>Banner Message</th>
                                        <th>Offer Message</th>
                                        <th>Banner Photo</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deleted_features as $deleted_feature)
                                        <tr>
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>{{ $deleted_feature->feature_name }}</td>
                                            <td>{{ $deleted_feature->feature_message }}</td>
                                            <td><img src="{{ asset('uploads\feature') . '/' . $deleted_feature->feature_photo }}"
                                                    style="background: linear-gradient(-155deg, #fd3d6b 0%, #fd7863 98%, #f3dfe0 100%); width:70px; height:70px;"
                                                    alt="feature photo"></td>
                                            <td class="d-flex">
                                                <form action="{{ route('feature.delete', $deleted_feature->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-trash  mr-1"></i>Permanent Delete</button>
                                                </form>
                                                <a href="{{ route('feature.restore', $deleted_feature->id) }}"
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
