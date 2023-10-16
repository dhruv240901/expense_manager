@extends('account.layout.app')
@section('title','View Transactions')
@section('content')
@include('includes.flash')
      <div class="container">
        <a href="{{route('my-accounts')}}" ><i class="material-icons purple lighten-2 backbtn" style="margin-top: 5%;">arrow_back</i></a>

      <table class="responsive-table" style="background-color: white; margin-top: 5%;">
        <thead>
            <tr>
                <th>Total Balance: {{$totalbalance}}</th>
            </tr>
          <tr>
              <th>Income</th>
              <th>Expense</th>
              <th>Action</th>
          </tr>
        </thead>

        <tbody>
            @foreach($transactions as $k=>$v)
          <tr>
            @if($v->type->name=="income")
                <td class="income">{{$v->amount}}({{$v->category->name}})</td>
                <td class="expense"></td>
            @endif
            @if($v->type->name=="expense")
            <td class="income"></td>
            <td class="expense">{{$v->amount}}({{$v->category->name}})</td>
            @endif
            @if($v->type->name=="transfer" && $v->account_id==$id)
                <td class="income"></td>
                <td class="expense">{{$v->amount}}(A/C No.{{$v->receiveraccount->account_number}})</td>
            @endif

            @if($v->type->name=="transfer" && $v->receiveraccount_id==$id)
                <td class="income">{{$v->amount}}(A/C No.{{$v->senderaccount->account_number}})</td>
                <td class="expense"></td>
            @endif
            <td>
                <a href="{{route('edit-transactions',$v->id)}}" type="button" class="btn btn-success" style="background-color:#1bcf1b">
                    <img src="{{asset('images/edit.svg')}}" alt="">
                </a>
                <form action="{{route('delete-transactions',$v->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?')" style="display: inline">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn red lighten-1">
                    <img src="{{asset('images/delete.svg')}}" alt="">
                </button>
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
@endsection
