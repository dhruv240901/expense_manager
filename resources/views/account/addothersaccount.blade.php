@extends('account.layout.app')
@section('title','Add Others Account')
@section('content')
        @include('includes.flash')

        <div class="row" style="background-color: white;margin-top: 5%;width: 50%;">
            <a href={{route('index')}}>  <i class="material-icons purple lighten-2 backbtn">arrow_back</i></a>

            <form class="col s12" id="addothersaccountform">
                <div class="row">
                   <h1 style="text-align: center;">Add Another's Account</h1>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                        <label for="email">Enter email</label>
                      <input id="email" type="text" class="validate" name="email">
                      <button type="button" class="waves-effect waves-light btn-large" id="searchaccount">Search</button>

                    </div>
                  </div>
                  <div class="row" id="searchaccounts">

                  </div>
            </form>
          </div>

<script>


$(document).ready(function(){
    $('#searchaccount').click(function(){
        $.ajax({
            url:'{{route('search-othersaccount')}}',
            method:'GET',
            data:{
                'email':$('#email').val(),
            },
            success:function(data){
                $('#searchaccounts').html(data)
            }
        });
    })
});

</script>
@endsection
