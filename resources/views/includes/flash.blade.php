@if ($message = Session::get('error'))
{{-- <div class="alert alert-danger" role="alert" id="message">
    {{ $message }}
  </div> --}}
  <div class="alert card red lighten-4 red-text text-darken-4" id="message">
    <div class="card-content">
        <p>{{$message}}</p>
    </div>
</div>
@endif
@if ($message = Session::get('success'))
<div class="alert card green lighten-4 green-text text-darken-4" id="message">
    <div class="card-content">
        <p>{{$message}}</p>
    </div>
</div>
@endif
<style>
    .alert {
	.card-content {
		span {
			font-weight: bold;
			font-size: 1.1em;
			margin-right:4px;
		}
		.material-icons {
			font-size: 1.5em;
			position: relative;
			top: 5px;
			margin-right: 0.5em;
		}
	}
}

</style>
