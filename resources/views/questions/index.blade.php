@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3>All Question</h3>
					<div class="ml-auto">
						<a href="{{ route('questions.create') }}" class="btn btn-outline-success">Ask Question</a>
					</div>
				</div>
				<div class="card-body">
					@foreach ($questions as $question)
					<div class="media">
						<div class="d-flex flex-column counters">
							<div class="votes">
								<strong>{{ $question->votes_count }}</strong> {{ str_plural('vote' , $question->votes_count) }}
							</div>
							<div class="status {{ $question->status }}">
								<strong>{{ $question->answers_count }}</strong> {{ str_plural('answer' , $question->answers_count) }}
							</div>
							<div class="view">
								{{ $question->views ." ". str_plural('view' , $question->views) }}
							</div>
						</div>
						<div class="media-body">
							<div class="d-flex align-items-center">
								<h3><a href="{{ route('questions.show' , $question->slug) }}">{{ $question->title }}</a></h3>
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
							<p class="lead">
								Asked By <a href="">{{ $question->user->name }}</a>&nbsp;
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