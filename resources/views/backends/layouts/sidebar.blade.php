<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
<<<<<<< HEAD
        <img src="{{ asset($company->photo) }}" alt="AdminLTE Logo"
=======
        <img src="{{ asset($company->photo ?? 'images/default-logo.png') }}" alt="AdminLTE Logo"
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-white">DOCUMENT SYSTEM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-0">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="margin: 0; padding: 0;">

                @php
                    // Define active states for better management
                    $currentRoute = Request::route()->getName();
                    $currentUrl = Request::url();

                    // Dashboard
                    $isDashboardActive = $currentRoute === 'admin.home';

                    // Document Management
                    $isDocumentActive = in_array($currentRoute, [
                        'admin.documents', 'admin.documents.create', 'admin.documents.edit', 'admin.documents.show',
                        'admin.document_category', 'admin.document_category.create', 'admin.document_category.edit'
                    ]);

                    // User Management
                    $isUserActive = in_array($currentRoute, [
                        'admin.user', 'admin.user.create', 'admin.user.edit',
                        'admin.role', 'admin.role.create', 'admin.role.edit', 'admin.role.permission',
                        'admin.permission', 'admin.permission.create', 'admin.permission.edit'
                    ]);

                    // System Settings
                    $isSettingsActive = in_array($currentRoute, [
                        'admin.company', 'admin.company.edit',
                        'admin.menu', 'admin.menu.create', 'admin.menu.edit'
                    ]);
                @endphp

                <!-- Dashboard -->
                <li class="nav-item" style="margin: 0;">
                    @if (checkPermission('dashboard', 'view'))
                    <a href="{{ route('admin.home') }}"
                       class="nav-link {{ $isDashboardActive ? 'active' : '' }}"
                       style="{{ $isDashboardActive ? 'background: rgba(255,255,255,0.2); color: white;' : 'color: rgba(255,255,255,0.8);' }} margin: 0; padding: 12px 15px;">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p style="margin: 0;">Dashboard</p>
                    </a>
                    @endif
                </li>

                <!-- Document Management -->
                <li class="nav-item {{ $isDocumentActive ? 'menu-open' : '' }}" style="margin: 0;">
                    <a href="#" class="nav-link {{ $isDocumentActive ? 'active' : '' }}"
                       style="{{ $isDocumentActive ? 'background: rgba(255,255,255,0.2); color: white;' : 'color: rgba(255,255,255,0.8);' }} margin: 0; padding: 12px 15px;">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p style="margin: 0;">
                            Document Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="background: rgba(0,0,0,0.1); margin: 0; padding: 0;">
                        @if (checkPermission('document_category', 'view'))
                        <li class="nav-item" style="margin: 0;">
                            <a href="{{ route('admin.document_category') }}"
                               class="nav-link {{ in_array($currentRoute, ['admin.document_category', 'admin.document_category.create', 'admin.document_category.edit']) ? 'active' : '' }}"
                               style="{{ in_array($currentRoute, ['admin.document_category', 'admin.document_category.create', 'admin.document_category.edit']) ? 'background: rgba(255,255,255,0.15); color: white;' : 'color: rgba(255,255,255,0.7);' }} margin: 0; padding: 8px 15px 8px 30px;">
                                <i class="nav-icon fas fa-folder"></i>
                                <p style="margin: 0;">Categories</p>
                            </a>
                        </li>
                        @endif

                        @if (checkPermission('document', 'view'))
                        <li class="nav-item" style="margin: 0;">
                            <a href="{{ route('admin.documents') }}"
                               class="nav-link {{ in_array($currentRoute, ['admin.documents', 'admin.documents.create', 'admin.documents.edit', 'admin.documents.show']) ? 'active' : '' }}"
                               style="{{ in_array($currentRoute, ['admin.documents', 'admin.documents.create', 'admin.documents.edit', 'admin.documents.show']) ? 'background: rgba(255,255,255,0.15); color: white;' : 'color: rgba(255,255,255,0.7);' }} margin: 0; padding: 8px 15px 8px 30px;">
                                <i class="nav-icon fas fa-file"></i>
                                <p style="margin: 0;">Documents</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                <!-- User Management -->
                <li class="nav-item {{ $isUserActive ? 'menu-open' : '' }}" style="margin: 0;">
                    <a href="#" class="nav-link {{ $isUserActive ? 'active' : '' }}"
                       style="{{ $isUserActive ? 'background: rgba(255,255,255,0.2); color: white;' : 'color: rgba(255,255,255,0.8);' }} margin: 0; padding: 12px 15px;">
                        <i class="nav-icon fas fa-users"></i>
                        <p style="margin: 0;">
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="background: rgba(0,0,0,0.1); margin: 0; padding: 0;">
                        @if (checkPermission('user', 'view'))
                        <li class="nav-item" style="margin: 0;">
                            <a href="{{ route('admin.user') }}"
                               class="nav-link {{ in_array($currentRoute, ['admin.user', 'admin.user.create', 'admin.user.edit']) ? 'active' : '' }}"
                               style="{{ in_array($currentRoute, ['admin.user', 'admin.user.create', 'admin.user.edit']) ? 'background: rgba(255,255,255,0.15); color: white;' : 'color: rgba(255,255,255,0.7);' }} margin: 0; padding: 8px 15px 8px 30px;">
                                <i class="nav-icon fas fa-user"></i>
                                <p style="margin: 0;">Users</p>
                            </a>
                        </li>
                        @endif

                        @if (checkPermission('role', 'view'))
                        <li class="nav-item" style="margin: 0;">
                            <a href="{{ route('admin.role') }}"
                               class="nav-link {{ in_array($currentRoute, ['admin.role', 'admin.role.create', 'admin.role.edit', 'admin.role.permission']) ? 'active' : '' }}"
                               style="{{ in_array($currentRoute, ['admin.role', 'admin.role.create', 'admin.role.edit', 'admin.role.permission']) ? 'background: rgba(255,255,255,0.15); color: white;' : 'color: rgba(255,255,255,0.7);' }} margin: 0; padding: 8px 15px 8px 30px;">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p style="margin: 0;">Roles</p>
                            </a>
                        </li>
                        @endif

                        @if (checkPermission('permission', 'view'))
                        <li class="nav-item" style="margin: 0;">
                            <a href="{{ route('admin.permission') }}"
                               class="nav-link {{ in_array($currentRoute, ['admin.permission', 'admin.permission.create', 'admin.permission.edit']) ? 'active' : '' }}"
                               style="{{ in_array($currentRoute, ['admin.permission', 'admin.permission.create', 'admin.permission.edit']) ? 'background: rgba(255,255,255,0.15); color: white;' : 'color: rgba(255,255,255,0.7);' }} margin: 0; padding: 8px 15px 8px 30px;">
                                <i class="nav-icon fas fa-key"></i>
                                <p style="margin: 0;">Permissions</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                <!-- System Settings -->
                <li class="nav-item {{ $isSettingsActive ? 'menu-open' : '' }}" style="margin: 0;">
                    <a href="#" class="nav-link {{ $isSettingsActive ? 'active' : '' }}"
                       style="{{ $isSettingsActive ? 'background: rgba(255,255,255,0.2); color: white;' : 'color: rgba(255,255,255,0.8);' }} margin: 0; padding: 12px 15px;">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p style="margin: 0;">
                            System Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="background: rgba(0,0,0,0.1); margin: 0; padding: 0;">
                        @if(checkPermission('company','view'))
                        <li class="nav-item" style="margin: 0;">
                            <a href="{{ route('admin.company') }}"
                               class="nav-link {{ in_array($currentRoute, ['admin.company', 'admin.company.edit']) ? 'active' : '' }}"
                               style="{{ in_array($currentRoute, ['admin.company', 'admin.company.edit']) ? 'background: rgba(255,255,255,0.15); color: white;' : 'color: rgba(255,255,255,0.7);' }} margin: 0; padding: 8px 15px 8px 30px;">
                                <i class="nav-icon fas fa-building"></i>
                                <p style="margin: 0;">Company Info</p>
                            </a>
                        </li>
                        @endif

                        @if(checkPermission('menu','view'))
                        <li class="nav-item" style="margin: 0;">
                            <a href="{{ route('admin.menu') }}"
                               class="nav-link {{ in_array($currentRoute, ['admin.menu', 'admin.menu.create', 'admin.menu.edit']) ? 'active' : '' }}"
                               style="{{ in_array($currentRoute, ['admin.menu', 'admin.menu.create', 'admin.menu.edit']) ? 'background: rgba(255,255,255,0.15); color: white;' : 'color: rgba(255,255,255,0.7);' }} margin: 0; padding: 8px 15px 8px 30px;">
                                <i class="nav-icon fas fa-bars"></i>
                                <p style="margin: 0;">Menu Management</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                <!-- Quick Actions -->
                <li class="nav-header" style="color: rgba(255,255,255,0.6); font-weight: bold; font-size: 0.8em; padding: 10px 15px; margin-top: 20px; margin-bottom: 0;">QUICK ACTIONS</li>

                @if (checkPermission('document', 'create'))
                <li class="nav-item" style="margin: 0;">
                    <a href="{{ route('admin.documents.create') }}" class="nav-link" style="color: rgba(255,255,255,0.8); margin: 0; padding: 12px 15px;">
                        <i class="nav-icon fas fa-plus-circle text-success"></i>
                        <p style="margin: 0;">Add Document</p>
                    </a>
                </li>
                @endif

                @if (checkPermission('user', 'create'))
                <li class="nav-item" style="margin: 0;">
                    <a href="{{ route('admin.user.create') }}" class="nav-link" style="color: rgba(255,255,255,0.8); margin: 0; padding: 12px 15px;">
                        <i class="nav-icon fas fa-user-plus text-info"></i>
                        <p style="margin: 0;">Add User</p>
                    </a>
                </li>
                @endif

                <!-- System Info -->
                <li class="nav-header" style="color: rgba(255,255,255,0.6); font-weight: bold; font-size: 0.8em; padding: 10px 15px; margin-top: 20px; margin-bottom: 0;">SYSTEM INFO</li>
                <li class="nav-item" style="margin: 0;">
                    <a href="#" class="nav-link" style="color: rgba(255,255,255,0.8); margin: 0; padding: 12px 15px;">
                        <i class="nav-icon fas fa-info-circle text-info"></i>
                        <p style="margin: 0;">Version 1.0.0</p>
                    </a>
                </li>
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
