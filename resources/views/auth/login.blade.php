@extends('layouts.auth')

@section('content')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>One Stop Click</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" name="email" class="form-control" placeholder="Email"  value="{{ old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
      </div>
      <div class="form-group">
        <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" {{ old('remember') ? 'checked' : '' }}  type="checkbox"> Remember Password</label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign in</button>
</form>

    <br>
    <p class="text-center"><b>OR</b> </p>
    
    <a href="{{url('login/google')}}" class="btn btn-danger btn-flat btn-block"><i class="fa fa-google-plus text-left"></i> Sign in with Google</a>
    
    <br><br>

    <a href="{{ url('/password/reset')}}">I forgot my password</a><br>
    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>



</body>
@endsection
