@extends('account.layout.app')

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
            @if($v->transactiontype_id==1)
                <td class="income">{{$v->amount}}({{$v->category->name}})</td>
                <td class="expense"></td>
            @endif
            @if($v->transactiontype_id==2)
            <td class="income"></td>
            <td class="expense">{{$v->amount}}({{$v->category->name}})</td>
            @endif
            @if($v->transactiontype_id==3 && $v->account_id==$id)
                <td class="income"></td>
                <td class="expense">{{$v->amount}}(A/C No.{{$v->receiveraccount->account_number}})</td>
            @endif

            @if($v->transactiontype_id==3 && $v->receiveraccount_id==$id)
                <td class="income">{{$v->amount}}(A/C No.{{$v->senderaccount->account_number}})</td>
                <td class="expense"></td>
            @endif
            <td>
                <a href="{{route('edit-transactions',$v->id)}}" type="button" class="btn btn-success" style="background-color:#1bcf1b">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
                </a>
                <form action="{{route('delete-transactions',$v->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?')" style="display: inline">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn red lighten-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                </svg>
                </button>
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
@endsection
