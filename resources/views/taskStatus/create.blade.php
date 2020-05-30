@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Add new task status</h1>
        {{ Form::model($taskStatus, ['url' => route('task_statuses.store')]) }}
            @include('taskStatus.form')
            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
