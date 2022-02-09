@extends("dashboard.dashboard")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('product.index')}}">Product</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Inventory</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header display-flix">
                            <div class="">
                                <h3 class="card-title">Add Inventory For <a class="text-primary"
                                        href="{{ route('product.product_details', $product->slug) }}">
                                        {{ $product->product_name }}</a></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('inventory.store', $product->id) }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Color <span class="text-danger">*</span></label>
                                        @foreach ($colors as $color)
                                            <div class="ml-3 form-check">
                                                <input class="form-check-input" type="radio" name="color"
                                                    id="color{{ $color->id }}"
                                                    {{ old('color') == $color->id ? 'checked' : '' }}
                                                    value="{{ $color->id }}" required>
                                                <label class="form-check-label text-capitalize"
                                                    for="color{{ $color->id }}">
                                                    <span class="rounded-circle mr-1"
                                                        style="background: {{ $color->color_code }};  border:1px solid red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    {{ $color->color_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        @error('color')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Size<span class="text-danger">*</span></label>
                                        <select autocomplete="OFF" name="size" id="size"
                                            class="form-control border border-dark  @error('size') is-invalid @enderror"
                                            required>
                                            <option value="">--Select size--</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                                            @endforeach
                                        </select>
                                        @error('size')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Quantity <span class="text-danger">*</span></label>
                                        <input type="text" name="quantity" value="{{ old('quantity') }}"
                                            placeholder=" Enter quantity"
                                            class="form-control border border-dark  @error('quantity')is-invalid @enderror"
                                            required>
                                        @error('quantity')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-end">
                                <div>
                                    <h3 class="card-title">Inventories Of <a class="text-primary"
                                            href="{{ route('product.product_details', $product->slug) }}">
                                            {{ $product->product_name }}</a>
                                    </h3>
                                </div>
                                <div class="text-right">
                                    <span class="badge bg-info text-light">Total
                                        Variation-{{ $inventories->count() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($inventories->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> #No</th>
                                                <th>Color Name</th>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                                <th>Market Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inventories as $color)
                                                <tr>
                                                    <td><strong>{{ $loop->index + 1 }}</strong></td>
                                                    <td>{{ $color->getColor->color_name }}</td>
                                                    <td> {{ $color->getSize->size }} </td>
                                                    <td> {{ $color->quantity }} </td>
                                                    <td> {{ $color->quantity * $product->discounted_price }} </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" class="text-right"> Total: </td>
                                                <td> {{ $total_qty = $inventories->sum('quantity') }} </td>
                                                <td> {{ $total_qty * $product->discounted_price }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div>
                                    <h5 class="text-center text-red">Inventories doesn't added yet</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
