@extends('dashboard.dashboard')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">
                            Subcategory Details
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Category Name</td>
                                    <td>{{ App\Models\Category::find($subcategory->category_id)->category_name }}</td>
                                </tr>
                                <tr>
                                    <td>Subcategory Name</td>
                                    <td>{{ $subcategory->subcategory_name }}</td>
                                </tr>
                                <tr>
                                    <td>Created at</td>
                                    <td>
                                        {{ $subcategory->created_at->format('d M Y') }}
                                        <div class="badge badge-info ">
                                            @if ($subcategory->created_at->diffInMinutes() < 1)
                                                {{ 'just now' }}
                                            @else
                                                {{ $subcategory->created_at->diffForHumans() }}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Created By</td>
                                    <td>
                                        {{ ucwords(App\Models\user::find($subcategory->created_by)->name) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Updated at</td>
                                    <td>
                                        @if ($subcategory->updated_at)
                                            {{ $subcategory->updated_at->format('d M Y') }}
                                        @endif
                                        <div class="badge badge-warning ">
                                            @if ($subcategory->updated_at)
                                                @if ($subcategory->updated_at->diffInMinutes() < 1)
                                                    {{ 'just now' }}
                                                @else
                                                    {{ $subcategory->updated_at->diffforhumans() }}
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
                                        @if ($subcategory->updated_by)
                                            {{ ucwords(App\Models\user::find($subcategory->updated_by)->name) }}
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
