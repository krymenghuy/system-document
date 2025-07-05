<aside class="main-sidebar sidebar-dark-primary bg-primary bg-opacity-50 text-light elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{  asset($company->photo ?? 'images/default-logo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
            {{-- <img src="{{ asset}}" alt=""> --}}
        <span class="brand-text font-weight-light "> DOCUMENT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(userAuth()->photo) }}" class=" rounded-circle" styl="width=35px;height=35px;"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ userAuth()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
            
                <li class="nav-item">
                    @if (checkPermission('dashboard', 'view'))
                    <a href="{{ route('admin.home') }}"
                        class="nav-link {{ request()->route()->getName() == 'admin.home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard

                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item {{ request()->route('admin.document.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link
                        {{ request()->route('admin.document.*') ? 'active' : '' }}
                    ">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Document Manager
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                
                    <ul class="nav nav-treeview">
                        @if (checkPermission('document_category', 'view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.document_category') }}"
                                    class="nav-link {{ Request::routeIs('admin.document_category*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
                                    <p>
                                        {{ __('Document_category') }}
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (checkPermission('document', 'view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.documents') }}"
                                    class="nav-link {{ Request::routeIs('admin.documents.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
                                    <p>
                                        {{ __('Document') }}
                                        <span class="right badge badge-danger">New</span>
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @php
                    $settingManagements = [
                        'admin.role',
                        'admin.role.create',
                        'admin.role.edit',
                        'admin.role.permission',
                        'admin.user',
                        'admin.user.create',
                        'admin.user.edit',
                        'admin.company',
                        'admin.company.edit'
                    ];
                @endphp
                <li
                    class="nav-item {{ in_array(request()->route()->getName(), $settingManagements) ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link
                        {{ in_array(request()->route()->getName(), $settingManagements) ? 'active' : '' }}
                    ">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (checkPermission('role', 'view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.role') }}"
                                    class="nav-link {{ request()->route()->getName() == 'admin.role' ||
                                    request()->route()->getName() == 'admin.role.create' ||
                                    request()->route()->getName() == 'admin.role.edit' ||
                                    request()->route()->getName() == 'admin.role.permission'
                                        ? 'active'
                                        : '' }}">
                                    <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
                                    <p>
                                        Role
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (checkPermission('user', 'view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.user') }}"
                                    class="nav-link {{ request()->route()->getName() == 'admin.user' ||
                                    request()->route()->getName() == 'admin.user.create' ||
                                    request()->route()->getName() == 'admin.user.edit'
                                        ? 'active'
                                        : '' }}">
                                    <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
                                    <p>
                                        User
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if(checkPermission('company','view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.company') }}" class="nav-link {{
                                request()->route()->getName() == 'admin.company' ||
                                request()->route()->getName() == 'admin.company.edit' ? 'active' : ''
                            }}">
                                <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
                                <p>
                                   {{ __('Company') }}
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
        </nav>
    </div>
</aside>






{{-- 
            </ul>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside> --}}
