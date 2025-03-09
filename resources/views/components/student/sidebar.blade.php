<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('assets/img/logo-small.png') }}">
            </div>
        </a>
        <a href="" class="simple-text logo-normal">
            {{ auth()->user()->name }}
        </a>
    </div>

    <div class="sidebar-wrapper"> <!-- Missing '>' here -->
        <ul class="nav">
            <li class="{{ Request::is('student/dashboard-component') ? 'active' : '' }}">
                <a href="javascript:void(0);" data-component="{{ route('student-dashboard-component.index') }}"onclick="loadComponent(this)">
                    <i class="nc-icon nc-bank"></i> <p>Dashboard</p>
                </a>
            </li>

            <li class = "{{ Request::is('student/grades-component') ? 'active' : '' }}">
                <a href="javascript:void(0);" data-component="{{ route('student-grades-component.index') }}" onclick="loadComponent(this)">
                    <i class="nc-icon nc-hat-3"></i> <p>Grades</p>
                </a>
            </li>
        </ul>
    </div>
</div>
