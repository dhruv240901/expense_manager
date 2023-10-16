@extends('account.layout.app')
@section('title','My Accounts')
@section('content')
@include('includes.flash')
      <div class="container">
        <a href="{{route('index')}}" ><i class="material-icons purple lighten-2 backbtn" style="margin-top: 5%;">arrow_back</i></a>

      <table class="responsive-table" style="background-color: white; margin-top: 5%;">
        <thead>
          <tr>
              <th>Account Holder</th>
              <th>Account Number</th>
              <th>Phone Number</th>
              <th>email</th>
              <th>Action</th>
          </tr>
        </thead>

        <tbody>
        @foreach($myaccounts as $k=>$v)
          <tr>
            <td>{{$v->holder_name}}</td>
            <td>{{$v->account_number}}</td>
            <td>{{$v->phone_number}}</td>
            <td>{{$v->email}}</td>
            <td>
                <a href="{{route('edit-account',$v->id)}}" type="button" class="btn btn-success" style="background-color:#1bcf1b">
                    <img src="{{asset('images/edit.svg')}}" alt="">
                </a>
                <form action="{{route('delete-account',$v->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this account?')" style="display: inline">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn red lighten-1">
                    <img src="{{asset('images/delete.svg')}}" alt="">
                </button>
                </form>

                <a href="{{route('view-transactions',$v->id)}}" type="button" class="btn blue" style="background-color:#1bcf1b">
                    View Transaction
                </a>
            </td>
          </tr>
        @endforeach
        @foreach($othersaccount as $k=>$v)
        <tr>
          <td>{{$v->account->holder_name}}</td>
          <td>{{$v->account->account_number}}</td>
          <td>{{$v->account->phone_number}}</td>
          <td>{{$v->account->email}}</td>
          <td>
              <a href="{{route('edit-account',$v->account->id)}}" type="button" class="btn btn-success" style="background-color:#1bcf1b">
              <img src="{{asset('images/edit.svg')}}" alt="">
              </a>

              <form action="{{route('delete-account',$v->account_id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this account?')" style="display: inline">
                  @csrf
                  @method('DELETE')
              <button type="submit" class="btn red lighten-1">
                <img src="{{asset('images/delete.svg')}}" alt="">
              </button>
              </form>
              <a href="{{route('view-transactions',$v->account_id)}}" type="button" class="btn blue" style="background-color:#1bcf1b">
                  View Transaction
              </a>
          </td>
        </tr>
      @endforeach
        </tbody>
      </table>
      </div>
@endsection
