@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.edit_task_status_title') }}</h1>
        {{ Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus), 'method' => 'PATCH']) }}
            @include('taskStatus.form')
            {{ Form::submit(__('tasks.update'), ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
