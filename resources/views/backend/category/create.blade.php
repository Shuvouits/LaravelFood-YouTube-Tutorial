 @extends('backend.master')

 @section('main')






 <div class="container-fluid">
     <div class="row">
         <div class="col-12">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h5>Category Information</h5>
                         </div>
                         <div class="card-body">
                            
                             <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">

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


                                 <div class="input-items">
                                     <div class="row gy-3">
                                         <div class="col-6">
                                             <div class="input-box">
                                                 <h6>Name</h6>
                                                 <input type="text" name="name" id="name" placeholder="Enter Your Name">
                                             </div>
                                         </div>

                                         <div class="col-6">
                                             <div class="input-box">
                                                 <h6>Slug</h6>
                                                 <input type="text" name="slug" id="slug" placeholder="Enter Your Slug">
                                             </div>
                                         </div>

                                         <!---ImagePreview--->

                                         <div>
                                             <img id="firstPreview" src="#" alt="Image Preview" style="display:none; height: 150px; width: 150px; border-radius: 75px; margin-top: 10px;">
                                         </div>

                                         <div class="col-12">
                                             <div class="input-box">
                                                 <h6>Image</h6>
                                                 <input type="file" name="image" class="imageInput" data-preview="#firstPreview" accept="image/*" >
                                             </div>
                                         </div>





                                         <div class="col-12">
                                             <div class="input-box">
                                                 <h6>Description</h6>
                                                 <textarea name="description" rows="4"></textarea>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="input-box d-flex align-items-center gap-2">
                                                 <input class="custom-checkbox" type="checkbox" id="c-1" name="status" value="yes">
                                                 <label for="c-1" class="mb-0">Status</label>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="input-box d-flex align-items-center gap-2">
                                                 <input class="custom-checkbox" type="checkbox" id="c-2" name="show_home" value="yes">
                                                 <label for="c-2" class="mb-0">Show in Homepage?</label>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <button type="submit" class="btn restaurant-button">Save</button>
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






 @endpush
