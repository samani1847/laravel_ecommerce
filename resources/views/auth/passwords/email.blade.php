@extends('layouts.auth')

@section('content')

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>One Stop Click</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
                    <p class="login-box-msg">Reset Password</p>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                             
                                        <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                                            Send Password Reset Link
                                        </button>

                                <br>
                                        <a href="{{ route('login') }}" class="text-center">Login</a>
                                        <br>
                                        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

                            </form>
                        </div>
        </div>
    </div>
</body>
@endsection
