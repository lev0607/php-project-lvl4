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
        <h1 class="mb-5">Add new task status</h1>
        {{ Form::model($task, ['url' => route('tasks.store')]) }}
        <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
        {{ Form::label('status_id', 'Status') }}
        <select name="status_id" class="form-control">
            @foreach ($taskStatuses as $taskStatus)
                <option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
        {{ Form::label('assigned_to_id', 'Assignee') }}
        <select name="assigned_to_id" class="form-control">
            <option value="">Assignee</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
        {{ Form::label('label_id', 'Labels') }}
        <select multiple class="multiselect-started form-control" data-placeholder="Choose labels" name="label_id[]">
            @foreach ($labels as $label)
                <option value="{{ $label->id }}">{{ $label->name }}</option>
            @endforeach
        </select>
        </div>
        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
