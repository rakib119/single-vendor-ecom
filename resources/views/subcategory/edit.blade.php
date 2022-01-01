@extends("dashboard.dashboard")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="card-header">
                <h5 class="card-title">Edit Subcategory</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="form-group col-6">
                        <label>Category Name <span class="text-danger">*</span></label>
                        <select name="category_id"
                            class="form-control border border-dark  @error('category_id')is-invalid @enderror">
                            <option value="">--Select Category--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    <?= $category->id == $subcategory->category_id ? 'selected' : '' ?>>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>Subcategory Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $subcategory->subcategory_name }}" name="subcategory_name"
                            class="form-control border border-dark   @error('subcategory_name')is-invalid @enderror">
                        @error('subcategory_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
