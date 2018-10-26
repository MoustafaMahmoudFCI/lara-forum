@extends('layouts.app')
@section('content')
<div class="container">
<div class="row mt-4" >
	<div class="col-md-12">
		<h2>Edit Your Answer to : {{ $question->title }}</h2>
		{!! Form::open(['route' => ['questions.answers.update', $question->id , $answer->id] , 'method' => 'patch']) !!}
		<div class="form-group">
			{!! Form::label('body', 'Edit Answer') !!}
			{!! Form::textarea('body', $answer->body , ['rows' => '20', 'class' => ($errors->has('body')?'form-control is-invalid' : 'form-control')]) !!}
			@if ($errors->has('body'))
			<span class="invalid-feedback"><strong>{{ $errors->first('body') }}</strong></span>
			@endif
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
		</div>
		{!! Form::close() !!}
	</div>
</div>
</div>
@endsection