<div class="row mt-4" >
	<div class="col-md-12">
		{!! Form::open(['route' => ['questions.answers.store', $question->id]]) !!}
		<div class="form-group">
			{!! Form::label('body', 'Your Answer') !!}
			{!! Form::textarea('body', old('body') , ['class' => ($errors->has('body')?'form-control is-invalid' : 'form-control')]) !!}
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