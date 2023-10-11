@extends('auth.layout.app')

@section('content')
  <form action="{{route('postforget-password')}}" method="POST" id="forgetpasswordform">
    @csrf
    @include('includes.flash')
    <h2>Forget Password</h2>
    <div>
        <h4><label for="email">Email</label><br></h4>
        <input type="email" class="input" name="email" id="email"><br>
        <span id="emailErr"></span>
    </div>
    <input type="submit" class="input">
  </form>
  <script>

  </script>
@endsection
