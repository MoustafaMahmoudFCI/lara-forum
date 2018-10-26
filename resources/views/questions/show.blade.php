@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="media">
				<h3 class="text-primary">{{ $question->title }}</h3>
			<div class="ml-auto">
				<a href="{{ route('questions.index') }}" class="btn btn-outline-success text-capitalize">back to all question</a>
			</div>
			</div>
			<div class="card mt-2">
				<div class="card-header py-2 ">
					<div class="media">
						<div class="media-body">
							<div class="d-flex align-items-center">
								<img class="mr-3" src="{{ asset('avatar.png') }}" width="40px" height="40px" alt="">
								<a href="">{{ $question->user->name }} </a>
								<p class="text-muted mb-0"> {{ $question->created_date }}</p>
								<div class="ml-auto">
									@can('update', $question)
									<a href="{{ route('questions.edit' , $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
									@endcan
									@can('delete', $question)
									{!! Form::open(['route' => ['questions.destroy' , $question->id] , 'method' => 'delete'  , 'class' => 'd-inline']) !!}
									<button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are You Sure ? ')">Delete</button>
									{!! Form::close() !!}
									@endcan
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="media">
						<div class="d-flex flex-column align-items-center vote-controls">
							<a class="vote-up" title="This question is useful">
								<i class="fa fa-caret-up fa-3x"></i>
							</a>
							<span class="votes-count">{{ $question->votes }}</span>
							<a class="vote-down off" title="This question is not useful">
								<i class="fa fa-caret-down fa-3x"></i>
							</a>
							<a class="favorite favorited" title="Mark as Favorite">
								<i class="fa fa-star fa-2x"></i>
								<span class="favorites-count">{{ $question->views }}</span>
							</a>
						</div>
						<div class="media-body">
							{!! Markdown::convertToHtml($question->body) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-4" >
		<div class="col-md-12">
			<h2 class="text-center mb-4 text-primary">{{ $question->answers_count ." ".str_plural('Answer' , $question->answers_count)}}</h2>
			@foreach ($question->answers as $answer)
			<div class="card mb-4">
				<div class="card-header">
					<div class="media">
						<img class="mr-3" src="{{ asset('avatar.png') }}" width="40px" height="40px" alt="">
						<div class="media-body">
							<a href="">{{ $answer->user->name }}</a>
							<p class="text-muted mb-0">{{ $answer->created_date }}</p>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="media">
						<div class="d-flex flex-column align-items-center vote-controls">
							<a class="vote-up" title="This answer is useful">
								<i class="fa fa-caret-up fa-3x"></i>
							</a>
							<span class="votes-count">{{ $answer->votes_count }}</span>
							<a class="vote-down off" title="This answer is not useful">
								<i class="fa fa-caret-down fa-3x"></i>
							</a>
							<a class="is-best-answer best-answer" title="Mark this as best answer">
								<i class="fa fa-check fa-2x"></i>
							</a>
						</div>
						<div class="media-body">
							{!! Markdown::convertToHtml($answer->body) !!}
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	@endsection