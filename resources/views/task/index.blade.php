@extends('layouts.app')

@section('task', 'active')
@section('content')
    <div class="container">
        <h1 class="mb-5">Tasks</h1>
        @if (Auth::check())
            <a href="{{route('tasks.create')}}" class="btn btn-primary mb-1">Add New</a>
        @endif
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Status</th>
                <th>Name</th>
                <th>Creator</th>
                <th>Assignee</th>
                <th>Created At</th>
                @if (Auth::check())
                    <th>Actions</th>
                @endif
            </tr>
            </thead>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{App\TaskStatus::find($task->status_id)->name}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{App\User::find($task->created_by_id)->name}}</td>
                    <td>{{$task->assigned_to_id ? App\User::find($task->assigned_to_id)->name : ""}}</td>
                    <td>{{$task->created_at}}</td>
                    @if (Auth::check())
                        <td><a href="{{route('tasks.edit', $task)}}">Edit</a>
                            <a href="{{ route('tasks.destroy', $task) }}"
                               data-method="delete"
                               rel="nofollow"
                               data-confirm="Are you sure?">Remove</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
@endsection
