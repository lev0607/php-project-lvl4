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
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name') }}
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description') }}
        {{ Form::label('status_id', 'Status') }}
        <select name="status_id">
            @foreach ($taskStatuses as $taskStatus)
                <option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
            @endforeach
        </select>
        {{ Form::label('assigned_to_id', 'Assignee') }}
        <select name="assigned_to_id">
            <option value="">Assignee</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
