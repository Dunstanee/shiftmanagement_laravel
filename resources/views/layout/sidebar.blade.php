<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse" >
        <div class="admin-block d-flex">
            <div>
                <img src="{{asset('assets/img/admin-avatar.png')}}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{session('staff')->first_name}}</div><small>Administrator</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{url('Dashboard')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">Main Control</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Employees</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('New-Employee')}}">New Employee</a>
                    </li>
                    <li>
                        <a href="{{url('Employee')}}">Manage Employee</a>
                    </li>
                    <li>
                        <a href="{{url('Sms')}}">Employee Message</a>
                    </li>
                    <li>
                        <a href="buttons.html">Make Groups</a>
                    </li>
                    <li>
                        <a href="tabs.html">Manage Groups</a>
                    </li>
                    <li>
                        <a href="alerts_tooltips.html">Employee Report</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-list"></i>
                    <span class="nav-label">Shifts</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="form_basic.html">New Shift</a>
                    </li>
                    <li>
                        <a href="form_advanced.html">Manage shift</a>
                    </li>
                    <li>
                        <a href="form_masks.html">Shift Category</a>
                    </li>
                    <li>
                        <a href="form_validation.html">Manage Category</a>
                    </li>
                    <li>
                        <a href="text_editors.html">Shift Report</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-send"></i>
                    <span class="nav-label">Messages</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="table_basic.html">Single Message</a>
                    </li>
                    <li>
                        <a href="datatables.html">Bulk Messages</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                    <span class="nav-label">Staffs</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="table_basic.html">New Staff</a>
                    </li>
                    <li>
                        <a href="datatables.html">Manage Staff</a>
                    </li>
                    <li>
                        <a href="datatables.html">Staff Report</a>
                    </li>
                </ul>
            </li>
            
            <li>
                <a href="calendar.html"><i class="sidebar-item-icon fa fa-lock"></i>
                    <span class="nav-label">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>