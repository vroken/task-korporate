<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="submenu ">
                    <a href="{{ route('list/users') }}"><i class="fas fa-graduation-cap"></i>
                        <span>Users</span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('list/users') }}" >Users</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <li >
                        <a href="/home/task">
                            <i class="feather-grid"></i>
                            <span>Tasks</span>
                        </a>
                    </li>
                </li>
            </ul>
        </div>
    </div>
</div>