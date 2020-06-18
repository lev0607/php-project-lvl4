@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.edit_tasks_title') }}</h1>
        {{ Form::model($task, ['url' => route('tasks.update', $task), 'method' => 'PATCH']) }}
            @include('task.form')
            <div class="form-group">
                {{ Form::label('label_id', __('tasks.labels')) }}
                <select multiple class="multiselect-started form-control" data-placeholder="Choose labels" name="label_id[]">
                    @foreach ($labels as $label)
                        @if($task->labels()->get()->contains($label))
                            <option selected value="{{ $label->id }}">{{ $label->name }}</option>
                        @else
                            <option value="{{ $label->id }}">{{ $label->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            {{ Form::submit(__('tasks.update'), ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
