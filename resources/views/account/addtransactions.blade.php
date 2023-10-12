@extends('account.layout.app')
@section('title','Add Transaction')
@section('content')
@include('includes.flash')
        <div class="row" style="background-color: white;margin-top: 5%;width: 50%;">
            <a href={{route('index')}}>  <i class="material-icons purple lighten-2 backbtn">arrow_back</i></a>
            <form class="col s12" action="{{route('store-transactions')}}" method="POST" id="addtransactionform">
                @csrf
                <div class="row">
                   <h1 style="text-align: center;">Add Transaction</h1>
                  </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="account_id" id="account_id">
                      <option value="" disabled selected>Choose your option</option>
                      @foreach ($useraccounts as $k=>$v)
                      <option value="{{$v->id}}">{{$v->holder_name}}({{$v->account_number}})</option>
                      @endforeach
                    </select>
                    <label>Select Account</label>
                  </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="amount" type="text" class="validate" name="amount">
                  <label for="amount">Amount</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                    <select name="category_id">
                      <option value="" disabled selected>Choose your option</option>
                      @foreach ($transactioncategory as $k=>$v)
                      <option value="{{$v->id}}">{{$v->name}}</option>
                      @endforeach

                    </select>
                    <label>Select Transaction Category</label>
                  </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                    <select id="category" name="type_id">
                      <option value="" disabled selected>Choose your option</option>
                      @foreach ($transactiontype as $k=>$v)
                      <option value="{{$v->id}}">{{$v->name}}</option>
                      @endforeach
                    </select>
                    <label>Select Transaction Type</label>
                  </div>
              </div>
              <div class="row" id="receiveraccount" name="receiver_id">
                <div class="input-field col s12">
                    <input id="receiveraccount_id" type="text" class="validate" name="receiveraccount_id">
                    <input id="receiver_account_id" type="hidden" class="validate" name="receiver_account_id">
                    <label>Enter Receiver's Account</label>
                    <ul class="demo" id='receiveraccounts'>

                    </ul>
                  </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                <button type="submit" class="waves-effect waves-light btn-large">Add Transaction</button>
                </div>
              </div>
            </form>
          </div>

<script>
//     document.addEventListener('DOMContentLoaded', function() {
//     var elems = document.querySelectorAll('.sidenav');
//     var instances = M.Sidenav.init(elems, options);
//   });

//   // Or with jQuery

//   $(document).ready(function(){
//     $('.sidenav').sidenav();
//   });
$(document).ready(function(){
    $('select').formSelect();
    $('#receiveraccount_id').keypress(function(){
        $.ajax({
            url:'{{route('account-search')}}',
            method:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                'receiveraccount_id':$('#receiveraccount_id').val(),
                'senderaccount_id':$('#account_id').val()
            },
            success:function(data){
                $('#receiveraccounts').html(data)
            }
        });
    })
});


$('#addtransactionform').validate({
    rules:{
        account_id:{
            required: function () {
                   if ($("#year option[value='0']")) {
                       return true;
                   } else {
                       return false;
                   }
               }
        },
        amount:{
            required:true,
            number:true
        },
        phone:{
            minlength:10,
            maxlength:10
        },
        email:{
            required:true,
            email:true
        },
    },
    messages:{
        account_id:"Please select account",
        amount:{
            required:"Please enter amount"
        },
        phone:{
            minlength:"Please enter valid phone number",
            maxlength:"Please enter valid phone number",

        },
        email:{
            required:"Please enter your email",
            email:"Please enter valid email"
        },
    },
    submitHandler: function(form) {
        form.submit();
    }
})
</script>
@endsection

