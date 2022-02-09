@extends('dashboard.dashboard')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Category Details</a></li>
                </ol>
            </div>
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">
                            Category Details
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Category Name</td>
                                    <td>{{ $category->category_name }}</td>
                                </tr>
                                <tr>
                                    <td>Created at</td>
                                    <td>
                                        {{ $category->created_at->format('d M Y') }}
                                        <div class="badge badge-info ">
                                            @if ($category->created_at->diffInMinutes() < 1)
                                                {{ 'just now' }}
                                            @else
                                                {{ $category->created_at->diffForHumans() }}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Created By</td>
                                    <td>
                                        {{ ucwords(App\Models\user::find($category->created_by)->name) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Updated at</td>
                                    <td>
                                        @if ($category->updated_at)
                                            {{ $category->updated_at->format('d M Y') }}
                                        @endif
                                        <div class="badge badge-warning ">
                                            @if ($category->updated_at)
                                                @if ($category->updated_at->diffInMinutes() < 1)
                                                    {{ 'just now' }}
                                                @else
                                                    {{ $category->updated_at->diffforhumans() }}
                                                @endif
                                            @else
                                                {{ 'Not updated yet' }}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Updated By</td>
                                    <td>
                                        @if ($category->updated_by)
                                            {{ ucwords(App\Models\user::find($category->updated_by)->name) }}

                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                            <a href="{{ url()->previous() }}" class=" btn btn-info "> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
