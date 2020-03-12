@extends('layouts.auth')

@section('content')
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href=""><b>One Stop Click</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>
    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
 
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
     
            <input id="email" type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password"  placeholder="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
    </div>

    <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="password_confirmation" required>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
    </div>

    <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
  </div>
</div>


</body>
@endsection
