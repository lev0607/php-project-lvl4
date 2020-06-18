@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.create_tasks_title') }}</h1>
        {{ Form::model($task, ['url' => route('tasks.store')]) }}
            @include('task.form')
            <div class="form-group">
                {{ Form::label('label_id', __('tasks.labels')) }}
                <select multiple class="multiselect-started form-control" data-placeholder="Choose labels" name="label_id[]">
                    @foreach ($labels as $label)
                        <option value="{{ $label->id }}">{{ $label->name }}</option>
                    @endforeach
                </select>
            </div>
            {{ Form::submit(__('tasks.create'), ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
