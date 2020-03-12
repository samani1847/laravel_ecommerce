<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- sidebar menu -->
   @include('layouts.partials.mainheader') 
   
   <div class="content-wrapper">
        <div class="container-fluid">
        <!-- content -->
            @yield('content')

        
        </div>
        <!-- footer -->
        @include('layouts.partials.footer')
    </div>

  

    @include('layouts.partials.scripts')

    
    <!-- Scripts -->
</body>
</html>
