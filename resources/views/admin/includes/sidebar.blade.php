<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <li class="{{ Request::is('admin/dashboard*') ? 'active' : ' ' }}">
                    <a href="{{ route('admin.dashboard') }}" ><i class="la la-dashboard"></i> <span>Dashboard</span></a>                 
                </li>
                
                <li class="menu-title">
                    <span>Main</span>
                </li>

                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/profile*') || Request::is('admin/password*') || Request::is('admin/detail*') ? 'active' : ' ' }}"><i class="la la-user-cog"></i> <span>Manage Account </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/profile*') ? 'active' : ' ' }}">
                            <a href="{{ route('admin.profile') }}">My Profile</a>
                        </li>
                        <li class="{{ Request::is('admin/password*') ? 'active' : ' ' }}">
                            <a href="{{ route('admin.password') }}">Change Password</a>
                        </li>                   
                    </ul>
                </li>
                
                

                <li class="{{ Request::is('admin/total-data*') ? 'active' : ' ' }}">
                    <a href="{{ route('admin.total-data') }}"><i class="la la-database"></i> <span>Total Data</span></a>
                </li>
                <li class="{{ Request::is('admin/fresh-data*') ? 'active' : ' ' }}">
                    <a href="{{ route('admin.fresh-data') }}"><i class="la la-list"></i> <span>Fresh Data</span></a>
                </li>

                {{-- <li class="menu-title">
                    <span>Content Management System</span>
                </li>
                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/cms/sub-admin*') ? 'active' : ' ' }}"><i class="la la-address-card"></i> <span>Admin Panel </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/cms/sub-admin*') ? 'active' : ' ' }}">
                            <a href="{{ route('cms.sub-admin.get-started') }}">Get Started Page</a>
                        </li>                   
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/cms/user*') ? 'active' : ' '}}"><i class="la la-newspaper"></i> <span>Member Panel </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/cms/user*') ? 'active' : ' ' }}">
                            <a href="{{ route('cms.user.get-started') }}">Get Started Page</a>
                        </li>                  
                    </ul>
                </li> --}}
               
            </ul> 
        </div>
    </div>
</div>


