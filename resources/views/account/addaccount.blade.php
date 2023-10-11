@extends('account.layout.app')
@section('content')
        @include('includes.flash')
        <div class="row" style="background-color: white;margin-top: 5%;width: 50%;">
            {{-- <a class="btn-floating btn-large waves-effect waves-light red"> --}}
              <a href={{route('index')}}>  <i class="material-icons purple lighten-2 backbtn">arrow_back</i></a>
            {{-- </a> --}}

            <form class="col s12" action="{{route('store-account')}}" method="POST" id="addaccountform">
                @csrf
                <div class="row">
                   <h1 style="text-align: center;">Add Account</h1>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                        <label for="name">Account Holder Name</label>
                      <input id="name" type="text" class="validate" name="name">

                    </div>
                  </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="accountnumber" type="text" class="validate" name="accountnumber">
                  <label for="accountnumber">Account No.</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="phone" type="text" class="validate" name="phone">
                  <label for="phone">Phone No.</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="email" type="email" class="validate" name="email" >
                  <label for="email">Email</label>
                </div>
              </div>
              <input type="hidden" id="userid" class="validate" name="user_id" value="{{auth()->id()}}">
              <div class="row">
                <div class="input-field col s12">
                <button type="submit" class="waves-effect waves-light btn-large">Add Account</button>
                </div>
              </div>
            </form>
          </div>
@endsection



