@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.create_task_status_title') }}</h1>
        {{ Form::model($taskStatus, ['url' => route('task_statuses.store')]) }}
            @include('taskStatus.form')
            {{ Form::submit(__('tasks.create'), ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
