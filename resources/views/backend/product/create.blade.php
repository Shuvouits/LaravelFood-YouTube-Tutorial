@extends('backend.master')

@section('main')
    <!-- New Product Add Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Product Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="input-items">

                                    <form method="post" action="{{ route('admin.product.store') }}"
                                        enctype="multipart/form-data">
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

                                        <div class="row gy-3">




                                            <div>
                                                <img id="firstPreview" src="#" alt="Image Preview"
                                                    style="display:none; height: 150px; width: 150px; border-radius: 75px; margin-top: 10px;">
                                            </div>

                                            <div class="col-12">
                                                <div class="input-box">
                                                    <h6>Image</h6>
                                                    <input type="file" name="image" class="imageInput"
                                                        data-preview="#firstPreview" accept="image/*">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="input-box">
                                                    <h6>Product Name</h6>
                                                    <input type="text" id="name" name="product_name"
                                                        value="{{ old('product_name') }}" placeholder="Product Name">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="input-box">
                                                    <h6>Slug</h6>
                                                    <input type="text" name="slug" id="slug"
                                                        value="{{ old('slug') }}" placeholder="Product Slug">
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="input-box">
                                                    <h6>Product Category <span style="color: red; font-weight:bold">*</span>
                                                    </h6>
                                                    <select class="js-example-basic-single w-100" name="product_category">

                                                         <option selected disabled >select</option>

                                                        @foreach ($category as $item)

                                                            <option value="{{ $item->id }}"
                                                                {{ old('product_category') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="input-box">
                                                    <h6>Price</h6>
                                                    <input type="number" name="price" value="{{ old('price') }}"
                                                        placeholder="Enter product price">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="input-box">
                                                    <h6>Offer Price</h6>
                                                    <input type="number" name="offer_price"
                                                        value="{{ old('offer_price') }}" placeholder="Enter Offer price">
                                                </div>
                                            </div>




                                            <div class="col-xl-12">
                                                <div class="input-box">
                                                    <h6>Short Description</h6>
                                                    <textarea name="short_description" style="height: 100px; color:lightgray"> {{ old('short_description') }}  </textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Long Description</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="input-items">
                                                            <div class="row gy-3">
                                                                <div class="col-12">
                                                                    <div class="input-box">
                                                                        <textarea id="editor" name="long_description">
                                                                            {{ old('long_description') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="input-box">
                                                    <h6>Today Special</h6>
                                                    <select class="form-select w-100" name="today_special">

                                                        <option value="no"
                                                            {{ old('today_special') == 'no' ? 'selected' : '' }}>No
                                                        </option>

                                                        <option value="yes"
                                                            {{ old('today_special') == 'yes' ? 'selected' : '' }}>Yes
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="input-box">
                                                    <h6>Status</h6>
                                                    <select class="form-select w-100" name="status">

                                                        <option value="active">Active</option>
                                                        <option value="inactive">InActive</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="input-box">
                                                    <h6>SEO Title</h6>
                                                    <input type="text" name="seo_title" value="{{ old('seo_title') }}"
                                                        placeholder="Enter seo title">
                                                </div>
                                            </div>


                                            <div class="col-xl-12">
                                                <div class="input-box">
                                                    <h6>SEO Description</h6>
                                                    <textarea name="seo_description">{{ old('seo_description') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn restaurant-button">Save</button>
                                            </div>





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
        $(document).ready(function() {
            $('#name').on('input', function() {
                let name = $(this).val();

                // Slug তৈরির নিয়ম: ছোট হরফ, স্পেস এর জায়গায় ড্যাশ
                let slug = name.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '') // special character বাদ
                    .replace(/\s+/g, '-') // স্পেস -> ড্যাশ
                    .replace(/-+/g, '-'); // একাধিক ড্যাশ -> একটি ড্যাশ

                $('#slug').val(slug);
            });
        });
    </script>
@endpush
