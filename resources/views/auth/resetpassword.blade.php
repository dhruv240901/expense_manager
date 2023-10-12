@extends('auth.layout.app')
@section('title','Reset Password')
@section('content')
  <form action="{{route('postreset-password')}}" method="POST" id="forgetpasswordform">
    @csrf
    @include('includes.flash')
    <h2>Reset Password</h2>
    <input type="hidden" value="{{$token}}" name="token">
    <div>
        <h4><label for="email">Email</label><br></h4>
        <input type="email" class="input" name="email" id="email" value="{{Session::get('email')}}" readonly><br>
        <span id="emailErr"></span>
    </div>
    <div>
        <h4><label for="email">Enter new password</label><br></h4>
        <input type="password" class="input" name="password" id="password"><br>
        <span id="emailErr"></span>
    </div>
    <input type="submit" class="input">
  </form>
  <script>

  </script>
@endsection
