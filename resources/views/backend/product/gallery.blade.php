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
                            <h5>{{$product->product_name}} - Gallery</h5>
                        </div>
                        <div class="card-body">
                            <div class="input-items">

                                <form method="post" action="{{ route('admin.imageGallery.store') }}" enctype="multipart/form-data">
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

                                    <div class="row gy-3">

                                        <div class="col-12">
                                            <div class="input-box">
                                                <h6>Upload Multiple</h6>
                                                <input type="file" name="images[]" id="imageInput" accept="image/*" multiple>
                                            </div>
                                        </div>

                                        <!-- Preview container -->
                                        <div class="col-12" id="previewContainer" style="display:flex; gap:10px; flex-wrap:wrap;">
                                            <!-- JS will append previews here -->
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="table-responsive theme-scrollbar">

                        <!-- Add Delete Button -->
                        <button id="bulk-delete-btn" class="btn btn-danger mb-3" style="display: none;">
                            Delete Selected
                        </button>

                        <div>
                            <table class="table category-table">
                                <thead>
                                    <tr>





                                        <th>Image</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($product_gallery as $key => $item)
                                    <tr>


                                        <td>
                                            @if ($item->image)
                                            <img src="{{ asset($item->image) }}"
                                                style="width: 80px; height: 80px; border-radius: 40px; " />
                                            @else
                                            <p>No Image Found</p>
                                            @endif
                                        </td>



                                        <td>
                                            <ul class="d-flex align-items-center  justify-content-center">




                                                <li>
                                                    <a class="delete-product" href="javascript:void(0)"
                                                        data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalToggle">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </li>





                                            </ul>

                                            <form id="delete-form" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

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
<!-- New Product Add End -->


 <!-- Delete Modal Box Start -->
    <div class="modal fade theme-modal remove-coupon" id="deleteConfirmModal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100">Are You Sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>This action is irreversible. Do you really want to delete this item?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>





@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#imageInput').on('change', function(event) {
            const files = event.target.files;
            const previewContainer = $('#previewContainer');

            // clear previous previews
            previewContainer.empty();

            Array.from(files).forEach((file, index) => {
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // wrapper div
                        const wrapper = $('<div>').css({
                            'position': 'relative',
                            'display': 'inline-block',
                            'margin': '5px'
                        });

                        // image
                        const img = $('<img>').attr('src', e.target.result).css({
                            'height': '150px',
                            'width': '150px',
                            'border-radius': '10px',
                            'object-fit': 'cover',
                            'box-shadow': '0 2px 6px rgba(0,0,0,0.2)'
                        });

                        // remove button
                        const removeBtn = $('<span>&times;</span>').css({
                            'position': 'absolute',
                            'top': '5px',
                            'right': '10px',
                            'color': 'white',
                            'background': 'rgba(0,0,0,0.6)',
                            'border-radius': '50%',
                            'cursor': 'pointer',
                            'font-size': '18px',
                            'padding': '2px 6px',
                            'line-height': '18px'
                        });

                        // remove click
                        removeBtn.on('click', function() {
                            wrapper.remove();
                        });

                        wrapper.append(img).append(removeBtn);
                        previewContainer.append(wrapper);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>


  <script>
        let productId = null;

        $(document).on('click', '.delete-product', function(e) {
            e.preventDefault();
            productId = $(this).data('id');

            // Show modal
            $('#deleteConfirmModal').modal('show');
        });

        $('#confirmDeleteBtn').on('click', function() {
            if (productId) {
                const deleteUrl = "{{ route('admin.imageGallery.destroy', ':id') }}".replace(':id',
                productId);
                $('#delete-form').attr('action', deleteUrl).submit();
            }
        });
    </script>





@endpush
