@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="card">
				<div class="card-header">All Questions</div>
				<div class="card-body">
					@foreach ($questions as $question)
					<div class="media">
						<div class="d-flex flex-column counters">
							<div class="votes">
								<strong>{{ $question->votes }}</strong> {{ str_plural('vote' , $question->votes) }}
							</div>
							<div class="status {{ $question->status }}">
								<strong>{{ $question->answers }}</strong> {{ str_plural('answer' , $question->answers) }}
							</div>
							<div class="view">
								{{ $question->views ." ". str_plural('view' , $question->views) }}
							</div>
						</div>
						<div class="media-body">
							<h3><a href="{{ route('questions.show' , $question->id) }}">{{ $question->title }}</a></h3>
							<p class="lead">
								Asked By <a href="">{{ $question->user->name }}</a>
								<small class="text-muted">{{ $question->created_date }}</small>
							</p>
							<p>{{ str_limit($question->body, 250) }}</p>
						</div>
					</div>
					<hr class="{{ $loop->last ? 'd-none' : '' }}">
					@endforeach
				</div>
				<div class="mx-auto">{{ $questions->render() }}</div>
			</div>
		</div>
	</div>
</div>
@endsection