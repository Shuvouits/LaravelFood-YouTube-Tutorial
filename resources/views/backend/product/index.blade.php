@extends('backend.master')

@section('main')
    <!-- All User Table Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All Product</h5>
                            <form class="d-inline-flex">
                                <a href="{{ route('admin.product.create') }}" class="align-items-center btn btn-theme d-flex">
                                    <i data-feather="plus-square"></i>Add New
                                </a>
                            </form>
                        </div>
                        <div class="table-responsive theme-scrollbar">

                            <!-- Add Delete Button -->
                            <button id="bulk-delete-btn" class="btn btn-danger mb-3" style="display: none;">
                                Delete Selected
                            </button>

                            <div>
                                <table class="table category-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th
                                                style="display: flex; align-items: center; justify-content: flex-start; gap: 15px">
                                                <span><input id="checkall" class="custom-checkbox" type="checkbox"></span>
                                                <span>All</span>

                                            </th>


                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Product Image</th>
                                            <th>Category</th>
                                            <th>Price</th>

                                            <th>Today Special</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($product as $key => $item)
                                            <tr>
                                                <td>
                                                    <input class="custom-checkbox single-checkbox" type="checkbox"
                                                        value="{{ $item->id }}">
                                                </td>

                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->product_name }}</td>
                                                <td>
                                                    @if ($item->image)
                                                        <img src="{{ asset($item->image) }}"
                                                            style="width: 80px; height: 80px; border-radius: 40px; " />
                                                    @else
                                                        <p>No Image Found</p>
                                                    @endif
                                                </td>
                                                <td>{{$item->category->name}}</td>
                                                <td>{{ $item->price }}</td>
                                                <td style="text-transform: capitalize;">
                                                    @if ($item->today_special == 'yes')
                                                        <span class="badge bg-primary">{{ $item->today_special }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $item->today_special }}</span>
                                                    @endif

                                                </td>

                                                  <td style="text-transform: capitalize;">
                                                    @if ($item->status == 'active')
                                                        <span class="badge bg-success">{{ $item->status }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $item->status }}</span>
                                                    @endif

                                                </td>



                                                <td>
                                                    <ul class="d-flex align-items-center  justify-content-center">


                                                        <li>
                                                            <a href="{{ route('admin.product.edit', $item->id) }}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a class="delete-product" href="javascript:void(0)"
                                                                data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalToggle">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>
                                                        </li>




                                                        <li>
                                                            <a href="{{route('admin.product.setting', $item->id)}}">
                                                                <i class="bi bi-gear-fill"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="{{route('admin.product.gallery', $item->id)}}">
                                                                <i class="bi bi-image"></i>
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
    <!-- All User Table Ends-->


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
        let productId = null;

        $(document).on('click', '.delete-product', function(e) {
            e.preventDefault();
            productId = $(this).data('id');

            // Show modal
            $('#deleteConfirmModal').modal('show');
        });

        $('#confirmDeleteBtn').on('click', function() {
            if (productId) {
                const deleteUrl = "{{ route('admin.product.destroy', ':id') }}".replace(':id',
                productId);
                $('#delete-form').attr('action', deleteUrl).submit();
            }
        });
    </script>

    <!-----bulk delete ---->

    <script>
        $(document).ready(function() {
            // Handle checkall toggle
            $('#checkall').on('change', function() {
                $('.single-checkbox').prop('checked', $(this).prop('checked'));
                toggleBulkDeleteButton();
            });

            // Handle individual checkbox change
            $('.single-checkbox').on('change', function() {
                if ($('.single-checkbox:checked').length === $('.single-checkbox').length) {
                    $('#checkall').prop('checked', true);
                } else {
                    $('#checkall').prop('checked', false);
                }
                toggleBulkDeleteButton();
            });

            // Toggle delete button
            function toggleBulkDeleteButton() {
                if ($('.single-checkbox:checked').length > 0) {
                    $('#bulk-delete-btn').show();
                } else {
                    $('#bulk-delete-btn').hide();
                }
            }

            // Handle delete button click
            $('#bulk-delete-btn').on('click', function() {
                let selectedIds = $('.single-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                Swal.fire({
                    title: "Are you sure?",
                    text: "You are about to delete " + selectedIds.length + " item(s)!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete them!",
                    cancelButtonText: "Cancel",
                    background: "#000", // black background
                    color: "#fff", // white text
                    customClass: {
                        popup: 'small-swal', // Add small font class
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request to delete
                        $.ajax({
                            url: "{{ route('admin.product.bulk-delete') }}",
                            method: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: selectedIds
                            },
                            success: function(response) {
                                Swal.fire({

                                    toast: true,
                                    position: 'top-end',
                                    title: response.message || "Deleted!",
                                    icon: 'success',
                                    background: 'black',
                                    color: '#ffffff',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    customClass: {
                                        popup: 'border border-gray-700 rounded-lg shadow'
                                    }



                                }).then(() => {
                                    location.reload(); // Reload after success
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
