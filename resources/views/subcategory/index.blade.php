@extends("dashboard.dashboard")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header display-flix">
                        <div class="">
                            <h3 class="card-title">Category list</h3>
                        </div>
                        <div class="">
                            <h3 class="card-title">
                                <a href="{{ route('subcategory.create') }}" class="btn btn-primary  mr-1">
                                    <i class="fa fa-plus mr-1"></i>Add Subcategory
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
                                        <th>Category Name</th>
                                        <th>Subcategory Name</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $subcategory)
                                        <tr>
                                            <td><strong>{{ $loop->index + 1 }}</strong></td>
                                            <td>{{ ucwords(App\Models\category::withTrashed()->find($subcategory->category_id)->category_name) }}
                                            </td>
                                            <td>{{ $subcategory->subcategory_name }}</td>
                                            <td>{{ ucwords(App\Models\user::find($subcategory->created_by)->name) }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge light badge-success">Active</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('subcategory.show', $subcategory->id) }}"
                                                        class="btn btn-success btn-sm mr-1">Details
                                                    </a>
                                                    <a href="{{ route('subcategory.edit', $subcategory->id) }}"
                                                        class="btn btn-warning btn-sm text-white mr-1">Edit
                                                    </a>
                                                    <form action="{{ route('subcategory.destroy', $subcategory->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm text-white mr-1">Delete</button>
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
@endsection
