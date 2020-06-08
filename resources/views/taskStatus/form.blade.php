@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif

{{ Form::label('name', __('tasks.name')) }}
{{ Form::text('name') }}
