@if (Session::has('success'))
	<div class="alert alert-success" role="alert">
		<strong>Success:</strong> {{ Session::get('success') }}
	</div>
@endif

@if (Session::has('error'))
	<div class="alert alert-danger" role="alert">
		<strong>Error:</strong> {{ Session::get('error') }}
	</div>
@endif

@if (Session::has('info'))
	<div class="alert alert-info" role="alert">
		<strong>Info:</strong> {{ Session::get('info') }}
	</div>
@endif