@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3>Edit Question</h3>
					<div class="ml-auto">
						<a href="{{ route('questions.index') }}" class="btn btn-outline-success text-capitalize">back to all questions</a>
					</div>
				</div>
				<div class="card-body">
					{!! Form::model($question , ['route' => ['questions.update' , $question->id ],'method' => 'PUT']) !!}
					@include('questions._form' , ['buttonText' => 'Update This Question'])
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection