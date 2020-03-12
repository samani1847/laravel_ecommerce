<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('home')}}">One Stop Click</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      
      @include('layouts.partials.menu')
    
   
      
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        
        @if (Auth::guest())
            <li><a href="{{ route('login') }}" class="btn btn-success">Login</a></li>
        @else
        <li class="dropdown nav-item">
                    <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-user"></i>  {{ Auth::user()->name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-fw fa-user"></i> Profile</a>
                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            <a href="{{ route('logout') }}" class="dropdown-item"  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                        </li>
                    </ul>
                </li>
      
        
        @endif
      </ul>
    </div>
  </nav>