@extends('account.layout.app')

@section('content')
@include('includes.flash')
    <div style="text-align: center;margin-top: 10%;font-family: 'Vesper Libre', serif;
    font-family: 'Young Serif', serif;">
        <h1>Welcome to Expense</h1></br>
        <h1>Manager</h1>
    </div>
</body>
</html>
<script>
//     document.addEventListener('DOMContentLoaded', function() {
//     var elems = document.querySelectorAll('.sidenav');
//     var instances = M.Sidenav.init(elems, options);
//   });

  // Or with jQuery

  $(document).ready(function(){
    $('.sidenav').sidenav();
  });
</script>
@endsection
