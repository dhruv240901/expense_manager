<nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo"><img src="https://assets.materialup.com/uploads/c2b5ecb4-ccae-4d53-b0fb-117058776fb4/preview.png" style="width: 85px"></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><img src="https://css-tricks.com/wp-content/uploads/2012/10/threelines.png" style="width: 10%;
        margin-top: 10px;"></a>
      <ul class="right hide-on-med-and-down">
        @guest
        <li><a href="{{route('login')}}">Login</a></li>
        <li><a href="{{route('signup')}}">SignUp</a></li>
        @endguest
        @auth
        <li><a href="{{route('add-account')}}">Add Account</a></li>
        <li><a href="{{route('my-accounts')}}">My Accounts</a></li>
        <li><a href="{{route('view-requests')}}">View Requests</a></li>
        <li><a href="{{route('add-transactions')}}">Add Transaction</a></li>
        <li><a href="{{route('logout')}}">logout</a></li>
        @endauth
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    @guest
    <li><a href="{{route('login')}}">Login</a></li>
    <li><a href="{{route('signup')}}">SignUp</a></li>
    @endguest
    @auth
    <li><a href="{{route('add-account')}}">Add Account</a></li>
    <li><a href="{{route('my-accounts')}}">My Accounts</a></li>
    <li><a href="{{route('view-requests')}}">View Requests</a></li>
    <li><a href="{{route('add-transactions')}}">Add Transaction</a></li>
    <li><a href="{{route('logout')}}">logout</a></li>
    @endauth
  </ul>
