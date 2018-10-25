@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			<h3 class="text-primary">{{ $question->title }}</h3>
			<div class="ml-auto">
				<a href="{{ route('questions.index') }}" class="btn btn-outline-success text-capitalize">back to all question</a>
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
						{!! $question->body !!}
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
						<div class="media-body">
							{{ $answer->body }}
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	@endsection