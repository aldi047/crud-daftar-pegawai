<li class="nav-item">
    <a href="/profile" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p class="text-nowrap">
            Users
            <span class="right badge badge-success">Employee</span>
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="/profiles" class="nav-link {{ request()->is('*employee*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-male"></i>
        <p class="text-nowrap">
            Information
            <span class="right badge badge-success">Employee</span>
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="/profiles" class="nav-link {{ request()->is('*employee*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-id-card"></i>
        <p class="text-nowrap">
            Personal
            <span class="right badge badge-success">Employee</span>
        </p>
    </a>
</li>
