@extends('backend.master')

@section('main')
<!-- New Product Add Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{$product->product_name}}</h5>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; align-items:center; justify-content:space-between">
                                <h5>Product Size</h5>
                                <button type="button" class="btn btn-sm btn-primary addSize">+</button>

                            </div>

                            <br>
                            <div class="input-items">

                                <form id="sizeForm" method="post" action="{{ route('admin.productSize.store') }}">
                                    @csrf

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <input type="hidden" name="product_id" value="{{$product->id}}" />

                                    <div id="sizeWrapper">
                                        @foreach($productSize as $item)


                                        <div class="row gy-3 size-row">



                                            <div class="col-xl-5">
                                                <div class="input-box">

                                                    <input type="text" id="name" name="product_size[]"
                                                        value="{{ old('product_size', $item->product_size) }}" placeholder="Product Size">
                                                </div>
                                            </div>

                                            <div class="col-xl-5">
                                                <div class="input-box">

                                                    <input type="number" name="product_price[]"
                                                        value="{{ old('product_price', $item->product_price) }}" placeholder="Product Price">
                                                </div>
                                            </div>


                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-danger removeSize">-</button>
                                            </div>




                                        </div>
                                        <div style="margin-top: 10px;"></div>
                                        @endforeach


                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                                    </div>






                                </form>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{$product->product_name}}</h5>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; align-items:center; justify-content:space-between">
                                <h5>Optional Item</h5>
                                <button type="button" class="btn btn-sm btn-primary addSize1">+</button>

                            </div>

                            <br>
                            <div class="input-items">

                                <form id="itemForm" method="post" action="{{ route('admin.optionalItem.store') }}">
                                    @csrf

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <input type="hidden" name="product_id" value="{{$product->id}}" />

                                    <div id="sizeWrapper1">
                                        @foreach($optionalItem as $data)


                                        <div class="row gy-3 size-row1">



                                            <div class="col-xl-5">
                                                <div class="input-box">

                                                    <input type="text" id="name" name="item_name[]"
                                                        value="{{ old('item_name', $data->item_name) }}" placeholder="Item Name">
                                                </div>
                                            </div>

                                            <div class="col-xl-5">
                                                <div class="input-box">

                                                    <input type="number" name="price[]"
                                                        value="{{ old('price', $data->price) }}" placeholder="Item Price">
                                                </div>
                                            </div>


                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-danger removeSize1">-</button>
                                            </div>




                                        </div>
                                        <div style="margin-top: 10px;"></div>
                                        @endforeach


                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                                    </div>






                                </form>

                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</div>
<!-- New Product Add End -->
@endsection

@push('scripts')
<script>
    $(document).on('click', '.addSize', function() {
        let row = `
        <div class="row gy-1 size-row mt-2">


            <div class="col-xl-5">
                                                <div class="input-box">

                                                    <input type="text" id="name" name="product_size[]"
                                                        value="{{ old('product_size') }}" placeholder="Product Size">
                                                </div>
                                            </div>

                                            <div class="col-xl-5">
                                                <div class="input-box">

                                                    <input type="number" name="product_price[]"
                                                        value="{{ old('product_price') }}" placeholder="Product Price">
                                                </div>
                                            </div>


                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-danger removeSize">-</button>
                                            </div>


        </div>
    `;
        $('#sizeWrapper').append(row);
    });

    $(document).on('click', '.removeSize', function() {
        $(this).closest('.size-row').remove();
    });
</script>


<script>
    $(document).on('click', '.addSize1', function() {
        let row = `
        <div class="row gy-1 size-row1 mt-2">


            <div class="col-xl-5">
                                                <div class="input-box">

                                                    <input type="text" id="name" name="item_name[]"
                                                        value="{{ old('item_name') }}" placeholder="Item Name">
                                                </div>
                                            </div>

                                            <div class="col-xl-5">
                                                <div class="input-box">

                                                    <input type="number" name="price[]"
                                                        value="{{ old('price') }}" placeholder="Price">
                                                </div>
                                            </div>


                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-danger removeSize1">-</button>
                                            </div>


        </div>
    `;
        $('#sizeWrapper1').append(row);
    });

    $(document).on('click', '.removeSize1', function() {
        $(this).closest('.size-row1').remove();
    });
</script>

@endpush
