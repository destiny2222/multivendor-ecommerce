<!-- Sidebar Logo -->
<div class="logo-box">
     <a href="{{ route('admin.dashboard') }}" class="logo-dark">
          <img src="/backend/images/logo-sm.png" class="logo-sm" alt="logo sm">
          <img src="/backend/images/logo-dark.png" class="logo-lg" alt="logo dark">
     </a>

     <a href="{{ route('admin.dashboard') }}" class="logo-light">
          <img src="/backend/images/logo-sm.png" class="logo-sm" alt="logo sm">
          <img src="/backend/images/logo-light.png" class="logo-lg" alt="logo light">
     </a>
</div>

<!-- Menu Toggle Button (sm-hover) -->
<button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
     <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
</button>

<div class="scrollbar" data-simplebar>
     <ul class="navbar-nav" id="navbar-nav">

          <li class="nav-item">
               <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Dashboard </span>
               </a>
          </li>

          <li class="menu-title mt-2">Users</li>

          <li class="nav-item">
               <a class="nav-link" href="{{ route('admin.vendors.index') }}">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:shop-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Vendors </span>
               </a>
          </li>

          <li class="nav-item">
               <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Customers </span>
               </a>
          </li>

          <li class="menu-title">General</li>

          <li class="nav-item">
               <a class="nav-link menu-arrow" href="#sidebarCategory" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarCategory">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Categories </span>
               </a>
               <div class="collapse" id="sidebarCategory">
                    <ul class="nav sub-navbar-nav">
                         <li class="sub-nav-item">
                              <a class="sub-nav-link" href="{{ route('admin.categories.index') }}">List</a>
                         </li>
                         <li class="sub-nav-item">
                              <a class="sub-nav-link" href="{{ route('admin.categories.create') }}">Create</a>
                         </li>
                    </ul>
               </div>
          </li>

          <li class="nav-item">
               <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarProducts">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Products </span>
               </a>
               <div class="collapse" id="sidebarProducts">
                    <ul class="nav sub-navbar-nav">
                         <li class="sub-nav-item">
                              <a class="sub-nav-link" href="{{ route('admin.products.index') }}">List</a>
                         </li>
                    </ul>
               </div>
          </li>

          <li class="nav-item">
               <a class="nav-link menu-arrow" href="#sidebarSliders" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarSliders">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:gallery-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Sliders </span>
               </a>
               <div class="collapse" id="sidebarSliders">
                    <ul class="nav sub-navbar-nav">
                         <li class="sub-nav-item">
                              <a class="sub-nav-link" href="{{ route('admin.sliders.index') }}">List</a>
                         </li>
                         <li class="sub-nav-item">
                              <a class="sub-nav-link" href="{{ route('admin.sliders.create') }}">Create</a>
                         </li>
                    </ul>
               </div>
          </li>

          <li class="nav-item">
               <a class="nav-link menu-arrow" href="#sidebarBanners" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarBanners">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Banners </span>
               </a>
               <div class="collapse" id="sidebarBanners">
                    <ul class="nav sub-navbar-nav">
                         <li class="sub-nav-item">
                              <a class="sub-nav-link" href="{{ route('admin.banners.index') }}">List</a>
                         </li>
                         <li class="sub-nav-item">
                              <a class="sub-nav-link" href="{{ route('admin.banners.create') }}">Create</a>
                         </li>
                    </ul>
               </div>
          </li>

          <li class="nav-item">
               <a class="nav-link menu-arrow" href="#sidebarOrders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarOrders">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Orders </span>
               </a>
               <div class="collapse" id="sidebarOrders">
                    <ul class="nav sub-navbar-nav">
                         <li class="sub-nav-item">
                              <a class="sub-nav-link" href="{{ route('admin.orders.index') }}">List</a>
                         </li>
                    </ul>
               </div>
          </li>

          <li class="menu-title">Other</li>

          <li class="nav-item">
               <a class="nav-link" href="{{ route('home') }}" target="_blank">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:earth-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> View Store </span>
               </a>
          </li>

     </ul>
</div>