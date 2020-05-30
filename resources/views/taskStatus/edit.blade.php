@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Edit task status</h1>
        {{ Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus), 'method' => 'PATCH']) }}
            @include('taskStatus.form')
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
