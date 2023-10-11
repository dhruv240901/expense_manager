@extends('account.layout.app')

@section('content')
@include('includes.flash')
        <div class="row" style="background-color: white;margin-top: 5%;width: 50%;">
            <a href="{{route('view-transactions',$transaction->account_id)}}">  <i class="material-icons purple lighten-2 backbtn">arrow_back</i></a>
            <form class="col s12" action="{{route('update-transactions',$transaction->id)}}" method="POST" id="addtransactionform">
                @csrf
                @method('put')
                <div class="row">
                   <h1 style="text-align: center;">Edit Transaction</h1>
                  </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="account_id">
                      <option value="" disabled selected>Choose your option</option>
                      @foreach ($useraccounts as $k=>$v)
                      <option value="{{$v->id}}" @if($transaction->account_id==$v->id) selected @endif>{{$v->holder_name}}({{$v->account_number}})</option>
                      @endforeach
                    </select>
                    <label>Select Account</label>
                  </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="amount" type="text" class="validate" name="amount" value="{{old('amount',$transaction->amount)}}">
                  <label for="amount">Amount</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                    <select name="category_id">
                      <option value="" disabled selected>Choose your option</option>
                      @foreach ($transactioncategory as $k=>$v)
                      <option value="{{$v->id}}"  @if($transaction->transactioncategory_id==$v->id) selected @endif>{{$v->name}}</option>
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
                      <option value="{{$v->id}}"  @if($transaction->transactiontype_id==$v->id) selected @endif>{{$v->name}}</option>
                      @endforeach
                    </select>
                    <label>Select Transaction Type</label>
                  </div>
              </div>
              @if($transaction->transactiontype_id==3)
              <div class="row" id="receiveraccount" name="receiver_id">
                <div class="input-field col s12">
                    <input id="receiveraccount_id" type="text" class="validate" name="receiveraccount_id">
                    <input id="receiver_account_id" type="hidden" class="validate" name="receiver_account_id">
                    <label>Enter Receiver's Account</label>
                    <ul class="demo" id='receiveraccounts'>

                    </ul>
                  </div>
              </div>
              @endif
              <input type="hidden" id="userid" class="validate" name="user_id" value="{{auth()->id()}}">
              <div class="row">
                <div class="input-field col s12">
                <button type="submit" class="waves-effect waves-light btn-large">Edit Transaction</button>
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
    // let se = $("#receiver_account :selected").val();
    // console.log(se);
    $('#receiveraccount').hide();
    $("#category").change(function() {
        if($('option:selected', this).val()==3){
            $('#receiveraccount').show();
        }
        else{
            $('#receiveraccount').hide();
        }
    });
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

//     $("#receiver_account").change(function(){
//   console.log($('#receiver_account:selected').val())
// });
});


$('#addtransactionform').validate({
    rules:{
        name:{
            required:true
        },
        accountnumber:{
            required:true
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
        name:"Please enter account holder name",
        accountnumber:{
            required:"Please enter account number"
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

