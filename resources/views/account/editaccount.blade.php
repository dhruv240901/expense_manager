@extends('account.layout.app')
@section('title','Edit Account')
@section('content')
@include('includes.flash')
        <div class="row" style="background-color: white;margin-top: 5%;width: 50%;">
            <a href={{route('my-accounts')}}>  <i class="material-icons purple lighten-2 backbtn">arrow_back</i></a>
            <form class="col s12" action="{{route('update-account',$account->id)}}" method="POST" id="editaccountform">
                @csrf
                @method('PUT')
                <div class="row">
                   <h1 style="text-align: center;">Edit Account</h1>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="name" type="text" class="validate" name="name" value="{{old('name',$account->holder_name)}}">
                      <label for="name">Account Holder Name</label>
                    </div>
                  </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="accountnumber" type="text" class="validate" name="accountnumber" value="{{old('accountnumber',$account->account_number)}}">
                  <label for="accountnumber">Account No.</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="phone" type="text" class="validate" name="phone" value="{{old('phone',$account->phone_number)}}">
                  <label for="phone">Phone No.</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="email" type="email" class="validate" name="email" value="{{old('email',$account->email)}}">
                  <label for="email">Email</label>
                </div>
              </div>
              <input type="hidden" id="userid" class="validate" name="user_id" value="{{auth()->id()}}">
              <div class="row">
                <div class="input-field col s12">
                <button type="submit" class="waves-effect waves-light btn-large">Update Account</button>
                </div>
              </div>
              {{-- <div class="row">
                <div class="col s12">
                  This is an inline input field:
                  <div class="input-field inline">
                    <input id="email_inline" type="email" class="validate">
                    <label for="email_inline">Email</label>
                    <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
                  </div>
                </div>
              </div> --}}
            </form>
          </div>

@endsection

