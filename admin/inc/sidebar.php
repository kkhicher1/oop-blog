<?php
if (!defined('sidebar')) {
    exit('you are not authrise to access this page');
}
?>


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="all-posts.php">
            <i class="fas fa-book"></i>
            <span>Posts</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="categories.php">
            <i class="fas fa-bezier-curve"></i>
            <span>Categories</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="tags.php">
            <i class="fas fa-tags"></i>
            <span>Tags</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="comments.php">
            <i class="fas fa-comment"></i>
            <span>Comments</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="users.php">
            <i class="fas fa-user-cog"></i>
            <span>User Settings</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="settings.php">
            <i class="fas fa-cogs"></i>
            <span>Settings</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>