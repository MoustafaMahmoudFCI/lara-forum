@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3>Ask Question</h3>
					<div class="ml-auto">
						<a href="{{ route('questions.index') }}" class="btn btn-outline-success text-capitalize">back to all questions</a>
					</div>
				</div>
				<div class="card-body">
					{!! Form::open(['route' => 'questions.store']) !!}
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
						<button type="submit" class="btn btn-outline-primary">Ask This Question</button>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection