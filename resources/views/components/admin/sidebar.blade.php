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

    <div class="sidebar-wrapper">
        <ul class="nav">
        <li class="{{ Request::is('admin/dashboard-component') ? 'active' : '' }}">
        <a href="javascript:void(0);" data-component="{{ route('dashboard-component.index') }}" onclick="loadComponent(this)">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="{{ Request::is('admin/student-component') ? 'active' : '' }}">
               <a href="javascript:void(0);" data-component="{{ route('student-component.index') }}" onclick="loadComponent(this)">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>STUDENT</p>
                </a>
            </li>

            <li class="{{ Request::is('admin/grade-component') ? 'active' : '' }}">
            <a href="javascript:void(0);" data-component="{{ route('grades-component.index') }}" onclick="loadComponent(this)">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>GRADES</p>
                </a>
            </li>

            <li class="{{ Request::is('admin/subject-component') ? 'active' : '' }}">
                <a href="javascript:void(0);" data-component="{{ route('subject-component.index') }}" onclick="loadComponent(this)">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>SUBJECT</p>
                </a>
            </li>



            <li class="{{ Request::is('admin/enroll-component') ? 'active' : '' }}">
            <a href="javascript:void(0);" data-component="{{ route('enroll-component.index') }}" onclick="loadComponent(this)">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>Enrollment</p>
                </a>
            </li>
        </ul>
    </div>
</div>
