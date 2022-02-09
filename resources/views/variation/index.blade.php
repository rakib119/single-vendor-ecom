@extends("dashboard.dashboard")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Variation List</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header display-flix">
                            <div class="">
                                <h3 class="card-title">Add Color</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('variation.color_post') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Color Name <span class="text-danger">*</span></label>
                                        <input type="text" autocomplete="off" name="color_name" class="form-control">
                                        @error('color_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Color Code <span class="text-danger">*</span></label>
                                        <input type="color" autocomplete="off" name="color_code"
                                            class="form-control col-2 ">
                                        @error('color_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header display-flix">
                            <div class="">
                                <h3 class="card-title">Add Size</h3>
                            </div>
                            <div class="card-title  d-flex">
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('variation.size_post') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Size <span class="text-danger">*</span></label>
                                        <input type="text" autocomplete="off" name="size" class="form-control">
                                        @error('size')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header display-flix">
                            <div class="">
                                <h3 class="card-title">Color List</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="width50"> #No</th>
                                            <th>Color Name</th>
                                            <th>Color Code</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($colors as $color)
                                            <tr>
                                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                                <td>{{ $color->color_name }}</td>
                                                <td> <span class="badge"
                                                        style="background: {{ $color->color_code }}">{{ $color->color_code }}</span>
                                                </td>
                                                <td>
                                                    {{-- <div class="d-flex justify-content-center">
                                                        <a href="{{ route('banner.edit', $color->id) }}"
                                                            class="btn btn-warning text-white mr-1"><i
                                                                class="fa fa-pencil  mr-1"></i>Edit
                                                        </a>
                                                        <form action="{{ route('banner.destroy', $color->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fa fa-trash  mr-1"></i>Delete</button>
                                                        </form>
                                                    </div> --}}
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('banner.edit', $color->id) }}">Edit</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                        </div>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header display-flix">
                            <div class="">
                                <h3 class="card-title">Size List</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="width50"> #No</th>
                                            <th>Size</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sizes as $size)
                                            <tr>
                                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                                <td>{{ $size->size }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('banner.edit', $size->id) }}"
                                                            class="btn btn-warning text-white mr-1"><i
                                                                class="fa fa-pencil  mr-1"></i>Edit
                                                        </a>
                                                        <form action="{{ route('banner.destroy', $size->id) }}"
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
            </div>
        </div>
    </div>

@endsection
