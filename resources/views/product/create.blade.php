@extends('dashboard.dashboard')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product</a></li>
                </ol>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Add Product</h2>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <h6>{{ session('success') }}</h6>
                        </div>
                    @endif
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="product_name"
                                    class="form-control border border-dark  @error('product_name')is-invalid @enderror"
                                    value="{{ old('product_name') }}">
                                @error('product_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Product Photo <span class="text-danger">*</span></label>
                                <input type="file" accept=".jpg,.JPG,.JPEG,.jpeg" name="product_photo"
                                    class="form-control border border-dark  @error('product_photo')is-invalid @enderror">
                                @error('product_photo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Category<span class="text-danger">*</span></label>
                                <select name="category_id" id="categoryId"
                                    class="form-control border border-dark  @error('category_id')is-invalid @enderror">
                                    <option value="">--Select Category--</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == old('category_id') ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Subcategory<span class="text-danger">*</span></label>
                                <select name="subcategory_id"
                                    class="form-control border border-dark  @error('subcategory_id')is-invalid @enderror">
                                    <option value="">--Select Subategory--</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == old('subcategory_id') ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Regular Price <span class="text-danger">*</span></label>
                                <input type="text" name="regular_price" value="{{ old('regular_price') }}"
                                    class="form-control border border-dark  @error('regular_price')is-invalid @enderror">
                                @error('regular_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Discounted Price</label>
                                <input type="text" name="discounted_price" value="{{ old('discounted_price') }}"
                                    class="form-control border border-dark  @error('discounted_price')is-invalid @enderror">
                                @error('discounted_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Product Weight</label>
                                <input type="text" name="weight" value="{{ old('weight') }}"
                                    class="form-control border border-dark  @error('weight')is-invalid @enderror">
                                @error('weight')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Product Dimensions</label>
                                <input type="text" name="dimensions" value="{{ old('dimensions') }}"
                                    class="form-control border border-dark  @error('dimensions')is-invalid @enderror">
                                @error('dimensions')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Product Materials </label>
                                <input type="text" name="materials" value="{{ old('materials') }}"
                                    class="form-control border border-dark  @error('materials')is-invalid @enderror">
                                @error('materials')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label> Other Information </label>
                                <input type="text" name="other_info" value="{{ old('other_info') }}"
                                    class="form-control border border-dark  @error('other_info')is-invalid @enderror">
                                @error('other_info')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Short Description <span class="text-danger">*</span></label>
                                <textarea name="short_description"
                                    class="form-control border border-dark  @error('short_description')is-invalid @enderror"
                                    rows="4">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Long Description <span class="text-danger">*</span></label>
                                <textarea name="description"
                                    class="form-control border border-dark  @error('description')is-invalid @enderror"
                                    rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#categoryId').change(() => {
                var category_id = $('#categoryId').val();
                // console.log(category_id);
                $.ajax({
                    url: 'product/get_subcat',
                    type: "post",
                    data: {
                        "category_id": category_id
                    }
                    success: function(results) {

                    }
                })
            });
        });

        // $('#categoryId').change(function() {
        //         var category_id = $('#categoryId').val();
        //         console.log(category_id);
        //         $.ajax({
        //             type: 'post',
        //             url: 'product/get_subcat',
        //             date: category_id: "category_id",
        //             success: (result) => {
        //                 alert(result)
        //             }
        //         });

        //     });
    </script>
@endsection
