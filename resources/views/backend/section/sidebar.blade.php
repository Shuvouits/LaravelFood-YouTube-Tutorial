 <div class="sidebar-wrapper">
     <div>
         <div class="logo-wrapper logo-wrapper-center">
             <a href="index.html" data-bs-original-title="" title="">
                 <img class="img-fluid for-white" src="{{ asset('backend/assets/images/logo/full-white.svg') }}"
                     alt="logo">
             </a>
             <div class="back-btn">
                 <i class="fa fa-angle-left"></i>
             </div>
             <div class="toggle-sidebar">
                 <i class="ri-apps-2-line status_toggle middle sidebar-toggle"></i>
             </div>
         </div>
         <div class="logo-icon-wrapper">
             <a href="index.html">
                 <img class="img-fluid main-logo" src="{{ asset('backend/assets/images/logo/logo.png') }}"
                     alt="logo">
             </a>
         </div>
         <nav class="sidebar-main">
             <div class="left-arrow" id="left-arrow">
                 <i data-feather="arrow-left"></i>
             </div>

             <div id="sidebar-menu">
                 <ul class="sidebar-links" id="simple-bar">
                     <li class="back-btn"></li>

                     <li class="sidebar-list">
                         <a class="sidebar-link sidebar-title link-nav" href="index.html">
                             <i class="ri-home-line"></i>
                             <span>Dashboard</span>
                         </a>
                     </li>

                     <li class="sidebar-list">
                         <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                             <i class="ri-store-3-line"></i>
                             <span>Manage Resturent</span>
                         </a>
                         <ul class="sidebar-submenu">
                             <li>
                                 <a href="{{ route('admin.product.create') }}">Create Prodcts</a>
                             </li>

                             <li>
                                 <a href="{{ route('admin.product.index') }}">Products</a>
                             </li>

                               <li>
                                 <a href="{{ route('admin.category.index') }}">Category List</a>
                             </li>

                               <li>
                                 <a href="add-new-product.html">Reservation</a>
                             </li>

                               <li>
                                 <a href="add-new-product.html">Product Reviews</a>
                             </li>



                         </ul>
                     </li>




                   
                 </ul>
             </div>

             <div class="right-arrow" id="right-arrow">
                 <i data-feather="arrow-right"></i>
             </div>
         </nav>
     </div>
 </div>
