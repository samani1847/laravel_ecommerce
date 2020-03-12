
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{ route('home')}}">
        <i class="fa fa-fw fa-dashboard"></i>
        <span class="nav-link-text">Dashboard</span>
        </a>
    </li>
  
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Menu Levels">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion" aria-expanded="false">
      <i class="fa fa-tasks"></i>
      <span class="nav-link-text">Category Management</span>
    </a>
    <ul class="sidenav-second-level collapse" id="collapseMulti" style="">
      @can('Category Management')
      <li>
        <a href="{{url('/admin/category/index')}}">Category</a>
      </li>
      @endcan
      @can('Subcategory Management')
      <li>
        <a href="{{url('/admin/subcategory/index')}}">Subcategory</a>
      </li>
      @endcan
    </ul>
  </li> 
    @can('Product Management')  
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="product">
          <a class="nav-link" href="{{url('/admin/product/index')}}">
          <i class="fa fa-cubes"></i>
          <span class="nav-link-text">Product Management</span>
          </a>
      </li>
    @endcan
    @can('Voucher Management')
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="product">
        <a class="nav-link" href="{{url('/admin/voucher/index')}}">
        <i class="fa fa-money"></i>
        <span class="nav-link-text">Voucher Management</span>
        </a>
    </li>
    @endcan
    
    @can('Role Management')
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="role">
        <a class="nav-link" href="{{url('/admin/role/index')}}">
        <i class="fa fa-lock"></i>
        <span class="nav-link-text">Role Management</span>
        </a>
    </li>
    @endcan
    @can('User Management')
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="role">
        <a class="nav-link" href="{{url('/admin/user/index')}}">
        <i class="fa fa-users"></i>
        <span class="nav-link-text">User Management</span>
        </a>
    </li>
    @endcan
    
    
    </ul>