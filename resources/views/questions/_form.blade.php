<div class="form-group">
	{!! Form::label('title', 'Question Title' ) !!}
	{!! Form::text('title', old('title') , ['class' => ($errors->has('title')) ? 'form-control is-invalid' : 'form-control']) !!}
	@if ($errors->has('title'))
	<div class="invalid-feedback">
		<strong>{{ $errors->first('title') }}</strong>
	</div>
	@endif
</div>
<div class="form-group">
	{!! Form::label('body', 'Explain Your Question' ) !!}
	{!! Form::textarea('body', old('body') , ['class' => ($errors->has('body')) ? 'form-control is-invalid' : 'form-control']) !!}
	@if ($errors->has('body'))
	<div class="invalid-feedback">
		<strong>{{ $errors->first('body') }}</strong>
	</div>
	@endif
</div>
<div class="form-group text-center">
	<button type="submit" class="btn btn-outline-primary">{{ $buttonText }}</button>
</div>