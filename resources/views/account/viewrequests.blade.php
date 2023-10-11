@extends('account.layout.app')

@section('content')
@include('includes.flash')
      <div class="container">
        <a href="{{route('index')}}" ><i class="material-icons purple lighten-2 backbtn" style="margin-top: 5%;">arrow_back</i></a>

      <table class="responsive-table" style="background-color: white; margin-top: 5%;">
        <thead>
          <tr>
              <th>User Name</th>
              <th>Account Number</th>
              <th>User Email</th>
          </tr>
        </thead>

        <tbody>
        @foreach($requests as $k=>$v)
         @if($v->accounts->owner_id==auth()->id())
          <tr>
            <td>{{$v->sender->name}}</td>
            <td>{{$v->accounts->account_number}}</td>
            <td>{{$v->sender->email}}</td>
            <td>
                @if($v->is_approved==0)
                <a href="{{route('approve-request',$v->id)}}" type="button" class="btn blue" style="background-color:#1bcf1b">
                    Approve
                </a>
                @else
                <a type="button" class="btn blue" style="background-color:#1bcf1b" disabled>
                    Approved
                </a>
                @endif
            </td>
          </tr>
          @endif
        @endforeach
        </tbody>
      </table>
      </div>

@endsection
