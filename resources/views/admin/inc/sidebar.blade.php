<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image text-center"><img src="{{ asset('dist/img/img1.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-envelope"></i></a> <a href="#"><i class="fa fa-gear"></i></a> <a
                    href="#"><i class="fa fa-power-off"></i></a>
            </div>
        </div>

        <!-- sidebar menu -->
        <aside class="main-sidebar">
            <div class="sidebar">
                <div class="user-panel">
                    <div class="image text-center">

                        @if ($user->profile_image)
                            <img src="{{ asset('uploads/profile_images/' . $user->profile_image) }}" class="img-circle"
                                alt="User Image">
                        @else
                            <img src="{{ asset('user-icon.webp') }}" class="img-circle" alt="User Image">
                        @endif


                    </div>
                    <div class="info">
                        <p>{{ $user->name }}</p>
                        <a href="#"><i class="fa fa-envelope"></i></a>
                        <a href="#"><i class="fa fa-gear"></i></a>
                        <a href="#"><i class="fa fa-power-off"></i></a>
                    </div>
                </div>

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">PERSONAL</li>

                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="icon-home"></i> <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- SETTINGS Menu --}}
                    @php
                        $settingsActive =
                            request()->routeIs('admin.whmcs.api.settings') || request()->routeIs('admin.mail.settings');
                    @endphp
                    <li class="treeview {{ $settingsActive ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-grid"></i>
                            <span class="routeParts">Settings</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ request()->routeIs('admin.whmcs.api.settings') ? 'active' : '' }}">
                                <a href="{{ route('admin.whmcs.api.settings') }}">
                                    <i class="fa fa-angle-right"></i> WHMCS Api Settings
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.mail.settings') ? 'active' : '' }}">
                                <a href="{{ route('admin.mail.settings') }}">
                                    <i class="fa fa-angle-right"></i> Mail Settings
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Profile Menu --}}
                    @php
                        // $profileActive = request()->segment(2) === 'profile';
                        $profileActive = request()->routeIs('profile') || request()->routeIs('manage.profiles');
                    @endphp
                    <li class="treeview {{ $profileActive ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-grid"></i>
                            <span class="routeParts">Profile</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            {{-- Use actual route names for app submenus below --}}
                            <li class="">
                                <a href="">
                                    <i class="fa fa-angle-right"></i> Profiles
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('manage.profiles') ? 'active' : '' }}">
                                <a href="{{ route('manage.profiles') }}">
                                    <i class="fa fa-angle-right"></i> Manage Profile
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Tasks Menu --}}
                    @php
                        $tasksActive = request()->routeIs('tasks') || request()->routeIs('manage.tasks');
                    @endphp
                    <li class="treeview {{ $tasksActive ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-grid"></i>
                            <span class="routeParts">Tasks</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ request()->routeIs('tasks') ? 'active' : '' }}">
                                <a href="{{ route('tasks') }}">
                                    <i class="fa fa-angle-right"></i> All Tasks
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('manage.tasks') ? 'active' : '' }}">
                                <a href="{{ route('manage.tasks') }}">
                                    <i class="fa fa-angle-right"></i> Manage Tasks
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </aside>

    </div>
    <!-- /.sidebar -->
</aside>
