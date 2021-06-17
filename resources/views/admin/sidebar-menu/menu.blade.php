<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview">
        <a href="{{ route('indexAdmin') }}">
            <i class="fa fa-dashboard"></i> <span>Админ-панель</span>
        </a>
    </li>
    @can('section-dashboard', $userRoles)
    <li><a href="{{ route('admin.hero') }}"><i class="fa fa-globe"></i> <span>Hero Section</span></a></li>
    <li><a href="{{ route('admin.about') }}"><i class="fa fa-sticky-note-o"></i> <span>About Section</span></a></li>
    <li><a href="{{ route('admin.client') }}"><i class="fa fa-magnet "></i> <span>Clients Section</span></a></li>
    <li><a href="{{ route('admin.feature') }}"><i class="fa fa-gavel"></i> <span>Features Section</span></a></li>
    <li><a href="{{ route('admin.service') }}"><i class="fa fa-tasks"></i> <span>Services Section</span></a></li>
    <li><a href="{{ route('admin.cta') }}"><i class="fa fa-tree"></i> <span>CTA Section</span></a></li>
    <li><a href="{{ route('admin.filter_portfolio') }}"><i class="fa fa-glass"></i> <span>Portfolio Section</span></a></li>
    <li><a href="{{ route('admin.count') }}"><i class="fa fa-bar-chart"></i> <span>Counts Section</span></a></li>
    <li><a href="{{ route('admin.testimonial') }}"><i class="fa fa-bullhorn"></i> <span>Testimonials Slider</span></a></li>
    <li><a href="{{ route('admin.team') }}"><i class="fa fa-diamond"></i> <span>Team Section</span></a></li>
    <li><a href="{{ route('admin.contact') }}"><i class="fa fa-phone"></i> <span>Contacts</span></a></li>
    <li><a href="{{ route('admin.map') }}"><i class="fa fa-phone"></i> <span>Map</span></a></li>
    <li><a href="{{ route('admin.social') }}"><i class="fa fa-phone"></i> <span>Socials</span></a></li>
    @endcan
    @can('user-dashboard', $userRoles)
    <li><a href="{{ route('admin.user') }}"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>
    @endcan
</ul>
