<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="https://www.youstable.com/assets/img/favicon.ico?v=2" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Youstable</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">


            @php
                $currentRoute = Route::currentRouteName();

                // Match session department to the correct route name
                $dashboardRouteName = match (session('USER_DEPARTMENT')) {
                    'seo' => 'team.leader.seo.dashboard',
                    'development' => 'team.leader.development.dashboard',
                    'support' => 'team.leader.support.dashboard',
                    'sales' => 'team.leader.sales.dashboard',
                };
            @endphp

            <li class="{{ $currentRoute === $dashboardRouteName ? 'mm-active' : '' }}">
                <a href="{{ route($dashboardRouteName) }}">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>

            <li class="{{ request()->routeIs('tasks', 'manage.tasks') ? 'mm-active' : '' }}">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">widgets</i></div>
                    <div class="menu-title">Tasks</div>
                </a>
                <ul>
                    <li><a href="{{ route('tasks') }}"><i class="material-icons-outlined">arrow_right</i>All Tasks</a>
                    </li>
                    <li><a href="{{ route('manage.tasks') }}"><i class="material-icons-outlined">arrow_right</i>Manage
                            Task</a></li>
                </ul>
            </li>


        </ul>
        <!--end navigation-->
    </div>
</aside>
