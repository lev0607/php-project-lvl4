@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <h1 class="mb-5">{{ __('tasks.edit_tasks_title') }}</h1>
        {{ Form::model($task, ['url' => route('tasks.update', $task), 'method' => 'PATCH']) }}
            {{ Form::model($task, ['url' => route('tasks.store')]) }}
            <div class="form-group">
                {{ Form::label('name', __('tasks.name')) }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('description', __('tasks.description')) }}
                {{ Form::text('description', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('status_id', __('tasks.status')) }}
                <select name="status_id" class="form-control">
                    @foreach ($taskStatuses as $taskStatus)
                        <option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('assigned_to_id', __('tasks.assignee')) }}
                <select name="assigned_to_id" class="form-control">
                    <option value="">Assignee</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
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
