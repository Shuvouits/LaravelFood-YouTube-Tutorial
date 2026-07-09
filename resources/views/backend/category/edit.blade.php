 @extends('backend.master')

 @section('main')





     <div class="container-fluid">
         <div class="row">
             <div class="col-12">
                 <div class="row">
                     <div class="col-12">
                         <div class="card">
                             <div class="card-header">

                                 <div style="display: flex; align-items: center; justify-content: space-between">

                                     <span>
                                         <h5>Update Category Info</h5>

                                     </span>

                                     <span>
                                         <form class="d-inline-flex">
                                             <a href="{{ route('admin.category.index') }}"
                                                 class="align-items-center btn btn-theme d-flex">
                                                 <i data-feather="arrow-left"></i>Back
                                             </a>
                                         </form>

                                     </span>




                                 </div>


                             </div>
                             <div class="card-body">

                                 <form action="{{ route('admin.category.update', $category->id) }}" method="post"
                                     enctype="multipart/form-data">

                                     @csrf
                                     @method('PUT')

                                     @if ($errors->any())
                                         <div class="alert alert-danger">
                                             <ul>
                                                 @foreach ($errors->all() as $error)
                                                     <li>{{ $error }}</li>
                                                 @endforeach
                                             </ul>
                                         </div>
                                     @endif


                                     <div class="input-items">
                                         <div class="row gy-3">
                                             <div class="col-6">
                                                 <div class="input-box">
                                                     <h6>Name</h6>
                                                     <input type="text" name="name" id="name"
                                                         placeholder="Enter Your Name" value="{{ $category->name ?? '' }}">
                                                 </div>
                                             </div>

                                             <div class="col-6">
                                                 <div class="input-box">
                                                     <h6>Slug</h6>
                                                     <input type="text" name="slug" id="slug"
                                                         value="{{ $category->slug ?? '' }}">
                                                 </div>
                                             </div>

                                             <!---ImagePreview--->

                                             <div>
                                                 <img id="imagePreview"
                                                     src="{{ $category->image ? asset($category->image) : '#' }}"
                                                     alt="Image Preview"
                                                     style="{{ $category->image ? 'height: 150px; width: 150px; border-radius: 75px; margin-top: 10px;' : 'display:none; height: 150px; width: 150px; border-radius: 75px; margin-top: 10px;' }}">
                                             </div>

                                             <div class="col-12">
                                                 <div class="input-box">
                                                     <h6>Image</h6>
                                                     <input type="file" name="image" id="imageInput" accept="image/*">
                                                 </div>
                                             </div>





                                             <div class="col-12">
                                                 <div class="input-box">
                                                     <h6>Description</h6>
                                                     <textarea name="description" rows="4" style="color: lightgray">{{ $category->description ?? '' }}</textarea>
                                                 </div>
                                             </div>
                                             <div class="col-12">
                                                 <div class="input-box d-flex align-items-center gap-2">
                                                     <input type="hidden" name="status" value="no">
                                                     <input class="custom-checkbox" type="checkbox" id="c-1"
                                                         name="status" value="yes"
                                                         {{ $category->status === 'yes' ? 'checked' : '' }}>

                                                     <label for="c-1" class="mb-0">Status</label>
                                                 </div>
                                             </div>
                                             <div class="col-12">
                                                 <div class="input-box d-flex align-items-center gap-2">

                                                     <input type="hidden" name="show_home" value="no">
                                                     <input class="custom-checkbox" type="checkbox" id="c-2"
                                                         name="show_home" value="yes"
                                                         {{ $category->show_home === 'yes' ? 'checked' : '' }}>
                                                     <label for="c-2" class="mb-0">Show in Homepage?</label>
                                                 </div>
                                             </div>
                                             <div class="col-12">
                                                 <button type="submit" class="btn restaurant-button">Update</button>
                                             </div>
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


     <script>
         $(document).ready(function() {
             $('#imageInput').change(function(event) {
                 const file = event.target.files[0];
                 if (file && file.type.startsWith('image/')) {
                     const reader = new FileReader();
                     reader.onload = function(e) {
                         $('#imagePreview').attr('src', e.target.result).show();
                     };
                     reader.readAsDataURL(file);
                 } else {
                     $('#imagePreview').hide();
                 }
             });
         });
     </script>
 @endpush
