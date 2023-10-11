@extends('auth.layout.app')

@section('content')

  <form action="{{route('custom-signup')}}" method="POST" id="signupform">
    @csrf
    @include('includes.flash')
    <h2>Signup form</h2>
    <div>
        <h4><label for="name">Name</label><br></h4>
        <input type="text" class="input" name="name" id="name"><br>
        <span id="nameErr"></span>
      </div>
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

    {{-- <div>
      <h4><label for="country">Country</label><br></h4>
      <select name="country" id="country">
        <option value="null" selected disabled hidden>Select An Option</option>
        <option value="india">India</option>
        <option value="usa">USA</option>
        <option value="china">China</option>
        <option value="paris">Japan</option>
      </select><br>
      <span id="countryErr"></span>
    </div>
    <div>
      <h4><label for="zip">Zip Code</label><br></h4>
      <input type="number" class="input" name="zip" id="zip"><br>
      <span id="zipErr"></span>
    </div>

    <div>
      <h4>Select your gender</h4>
      <input type="radio" id="male" name="gender" value="male">
      <label for="male">Male</label><br>
      <input type="radio" id="female" name="gender" value="female">
      <label for="female">Female</label><br>
      <span id="genderErr"></span>
    </div>
    <div>
      <h4>Select languages you know</h4>
      <input type="checkbox" id="lang1" name="english" value="english">
      <label for="lang1">English</label><br>
      <input type="checkbox" id="lang2" name="hindi" value="hindi">
      <label for="lang2">Hindi</label><br>
      <input type="checkbox" id="lang3" name="tamil" value="tamil">
      <label for="lang3">Tamil</label><br>
      <span id="languageErr"></span>
    </div> --}}
    <input type="submit" class="input">
    <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
    {{-- <input type="reset" class="input"> --}}
  </form>
  {{-- <div id="popup" style="">
    <div id="data">
      <span class="close">&times;</span><br>
      <p></p>
    </div>
  </div> --}}
<script>

</script>
@endsection
