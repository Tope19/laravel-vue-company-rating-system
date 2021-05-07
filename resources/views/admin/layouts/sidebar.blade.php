<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a class="" style="" href="{{route('home')}}">Companies</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MY</a>
        </div>
        @php
            function isActiveUrl($url){
                $current_url = url()->current();
                $base_url = env('APP_URL');
                return $base_url . $url === $current_url ? 'active' : '';
            }
        @endphp
        <ul class="sidebar-menu">
            <li><a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i> <span>Home</span></a></li>

            <li class="menu-header">Dashboard</li>
            <li class="{{isActiveUrl('/admin/companies')}}"><a class="nav-link" href="{{route('companies.index')}}"><i class="fas fa-list"></i> <span>Companies</span></a></li>
        </ul>
    </aside>
</div>
