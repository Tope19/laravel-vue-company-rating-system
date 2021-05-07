<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="">
            <a href="#" data-toggle="" class="nav-link nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block">Hi, {{auth()->user()->name}}</div></a>
        </li>

        <li style="margin-right: 20px;">
           <a href="{{ route('logout') }}" class="dropdown-item has-icon text-center border btn btn-outline-white"
              onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
               <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
