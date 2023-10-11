@extends('account.layout.app')

@section('content')
@include('includes.flash')
        <div class="row" style="background-color: white;margin-top: 5%;width: 50%;">
            <a href={{route('index')}}>  <i class="material-icons purple lighten-2 backbtn">arrow_back</i></a>
            <form class="col s12" action="{{route('update-password')}}" method="POST" id="changepasswordform">
                @csrf
                <div class="row">
                   <h1 style="text-align: center;">Change Password</h1>
                  </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="currentpassword" type="text" class="validate" name="currentpassword">
                  <label for="currentpassword">Enter current password</label>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="newpassword" type="text" class="validate" name="newpassword">
                  <label for="newpassword">Enter new password</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="confirmpassword" type="text" class="validate" name="confirmpassword">
                  <label for="confirmpassword">Confirm new password</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                <button type="submit" class="waves-effect waves-light btn-large">Update Password</button>
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


$('#changepasswordform').validate({
    rules:{
        currentpassword:{
            required:true,
        },
        newpassword:{
            required:true,
            minlength:8,
        },
        confirmpassword:{
            required:true,
            equalTo:'#newpassword'
        }
    },
    messages:{
        currentpassword:{
                required:"Please enter your current password",
            },
        newpassword:{
            required:"Please enter password",
            minlength:"Please enter password greater than or equal to 8 characters",
        },
        confirmpassword:{
            required:"Please confirm password",
            equalTo:'Password is not matching',
        }
    },
    submitHandler: function(form) {
        form.submit();
    }
})
</script>
@endsection

