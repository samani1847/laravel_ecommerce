<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<style>
    footer.sticky-footer{
        width:100%
    }
    .content-wrapper{
        margin: 0px;
    }
    .container-fluid{
        margin: 30px 0px 0px 0px;
    }
    
    <style>
    /* .card-title{
        margin-top:15px;
    } */
    .card-group {
      display: flex;
      width: 100%;
  }

  .card-deck .card {
      display: flex;
      //flex: 1 1 auto;
      flex-direction: column;
      justify-content: space-between;
  }

  .card-deck {
      margin-top:30px;
      margin-bottom:30px;
  }
  .navbar-nav > li{
      margin-right:30px;
  }

  .card-block {
    flex: 1 1 auto;
  }
    .card-block{
        margin:10px
    }
</style>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- sidebar menu -->
   @include('layouts.partials.mainheaderwithoutmenu') 
   
   <div class="content-wrapper">
        <div class="container-fluid">
        <!-- content -->
            @yield('content')
           
        
        </div>
        <!-- footer -->
        @include('layouts.partials.footer')
    </div>

  
    @include('layouts.partials.cart-modal')
    @include('layouts.partials.scripts')

    <script type="text/javascript" src="{{ asset('js/cart.js')}}"></script>

    
    <!-- Scripts -->
</body>
</html>
