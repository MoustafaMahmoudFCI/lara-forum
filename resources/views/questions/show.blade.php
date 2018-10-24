@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3>{{ $question->title }}</h3>
					<div class="ml-auto">
						<a href="{{ route('questions.index') }}" class="btn btn-outline-success text-capitalize">back to all question</a>
					</div>
				</div>
				<div class="card-body">
					<div class="media">
						{!! $question->body !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection