
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold ms-2">DermaConnect</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item active open">
            <a href="{{ route('dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>
        <!-- disease button -->
        <li class="menu-item ">
            <a href="{{ route('disease.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                Disease
            </a>
        </li>

        <!-- Skin Services -->
        <li class="menu-item ">
            <a href="{{ route('skincare.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spa"></i>
                Skin Services
            </a>
        </li>

 
        <!-- Review Cards -->
          <li class="menu-item ">
            <a href="{{ route('review.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                Review Cards
            </a>
        </li>
        <li class="menu-item ">
            <a href="{{ route('permission.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                Permissions
            </a>
        </li>
         <li class="menu-item ">
            <a href="{{ route('role.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
         Roles
            </a>
        </li>
        <!-- Articles -->
        <li class="menu-item ">
            <a href="{{ route('article.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                Articles
            </a>
        </li>
          
         <li class="menu-item ">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                Users
            </a>
             </li>
               <li class="menu-item ">
            <a href="{{ route('dermatologist.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                view Dermatologist
            </a>
             </li>
    </ul>
</aside>
