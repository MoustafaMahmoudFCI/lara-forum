<div class="row mt-4" >
	<div class="col-md-12">
		<h2 class="text-center mb-4 text-primary">{{ $question->answers_count ." ".str_plural('Answer' , $question->answers_count)}}</h2>
		@foreach ($answers as $answer)
		<div class="card mb-4">
			<div class="card-header">
				<div class="media">
					<img class="mr-3" src="{{ asset('avatar.png') }}" width="40px" height="40px" alt="">
					<div class="media-body">
						<div class="d-flex align-items-center">
						<a href="">{{ $answer->user->name }}</a>&nbsp;
						<p class="text-muted mb-0">{{ $answer->created_date }}</p>
						<div class="ml-auto">
							@can('update', $answer)
							<a href="{{ route('questions.answers.edit' , [$question->id , $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
							@endcan
							@can('delete', $answer)
							{!! Form::open(['route' => ['questions.answers.destroy' , $question->id , $answer->id] , 'method' => 'delete'  , 'class' => 'd-inline']) !!}
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
						<a class="vote-up" title="This answer is useful">
							<i class="fa fa-caret-up fa-3x"></i>
						</a>
						<span class="votes-count">{{ $answer->votes_count }}</span>
						<a class="vote-down off" title="This answer is not useful">
							<i class="fa fa-caret-down fa-3x"></i>
						</a>
						@can('bestAnswer' , $answer)
						<a class="is-best-answer {{ $answer->status }}" title="Mark this as best answer" onclick="event.preventDefault(); document.getElementById('best_answer_{{ $answer->id }}').submit()">
							<i class="fa fa-check fa-2x"></i>
						</a>
						<form id="best_answer_{{ $answer->id }}" action="{{ route('answers.best_answer' , $answer->id) }}" class="hidden" method="post">
							@csrf
						</form>
						@else
						@if ($answer->is_best_answer)
								<a class="is-best-answer {{ $answer->status }}" title="Question owner Marked this answer as best answer">
							<i class="fa fa-check fa-2x"></i>
						</a>
						@endif
						@endcan
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
