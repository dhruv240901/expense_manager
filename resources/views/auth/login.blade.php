@extends('auth.layout.app')

@section('content')
  <form action="{{route('custom-login')}}" method="POST" id="loginform">
    @csrf
    @include('includes.flash')
    <h2>Login form</h2>
    <div>
        <h4><label for="email">Email</label><br></h4>
        <input type="email" class="input" name="email" id="email"><br>
        <span id="emailErr"></span>
    </div>
    <div>
      <h4><label for="password">Password</label><br></h4>
      <input type="password" class="input" name="password" id="password"><br>
      <span id="passwordErr"></span>
    </div>
    <input type="submit" class="input" style="background-color: var(--secondary-color);color:white">
    <a href="{{route('forget-password')}}">Forget Password?</a>
    <p>Create a new account? <a href="{{route('signup')}}">Signup</a></p>
  </form>
  <script>

  </script>
@endsection
