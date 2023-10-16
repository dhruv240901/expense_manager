<table>
    <thead>
    <tr>
        <th>Account holder</th>
        <th>Account No.</th>
    </tr>
    </thead>
    <tbody>
        @foreach($user->accounts as $k=>$v)
        <tr>
            <td>{{$v->holder_name}}</td>
            <td>{{$v->account_number}}</td>
            <td>
                <a href="{{route('send-request',$v->id)}}" type="button" class="btn blue" style="background-color:#1bcf1b">Send Request</button>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
