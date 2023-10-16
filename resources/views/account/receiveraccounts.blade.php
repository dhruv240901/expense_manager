@foreach($receiveraccounts as $k=>$v)
    <li id='{{$v->id}}-receiveraccount'>{{$v->account_number}} ({{$v->holder_name}})</li>
    <script>
    $('#{{$v->id}}-receiveraccount').css('cursor','pointer')

    $('#{{$v->id}}-receiveraccount').click(function(){
        $('#receiveraccount_id').val($('#{{$v->id}}-receiveraccount').text());
        $('#receiver_account_id').val("{{$v->id}}")
        $('#receiveraccounts').hide()
    })
    </script>

@endforeach
