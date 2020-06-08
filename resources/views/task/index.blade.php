@extends('layouts.app')

@section('task', 'active')
@section('content')
    <div class="container">
        <h1 class="mb-5">Tasks</h1>
        @if (Auth::check())
            <a href="{{route('tasks.create')}}" class="btn btn-primary mb-1">Add New</a>
        @endif
        <form method="GET" action="?" accept-charset="UTF-8" class="form-inline">
            <select class="form-control mr-2" name="filter[status_id]">
                <option value="">Statuses</option>
                @foreach ($taskStatuses as $taskStatus)
                    <option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
                @endforeach
            </select>
            <select class="form-control mr-2" name="filter[created_by_id]">
                <option value="">Users</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <select class="form-control mr-2" name="filter[assigned_to_id]">
                <option value="">Assignee</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <select class="form-control mr-2" name="filter[labels.name]">
                <option value="">Labels</option>
                @foreach ($labels as $label)
                    <option value="{{ $label->name }}">{{ $label->name }}</option>
                @endforeach
            </select>
            <input class="btn btn-outline-primary mr-2" type="submit" value="Apply">
        </form>
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Status</th>
                <th>Name</th>
                <th>Creator</th>
                <th>Assignee</th>
                <th>Labels</th>
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
                    <td><a href="{{ route('tasks.show', $task) }}">{{$task->name}}</a></td>
                    <td>{{App\User::find($task->created_by_id)->name}}</td>
                    <td>{{$task->assigned_to_id ? App\User::find($task->assigned_to_id)->name : ""}}</td>
                    <td>
                        @foreach ($task->labels()->get() as $label)
                            {{$label->name . " "}}
                        @endforeach
                    </td>
                    <td>{{$task->created_at}}</td>
                    @if (Auth::check())
                        <td><a href="{{route('tasks.edit', $task)}}">Edit</a>
                            @if (auth()->user()->id === $task->created_by_id)
                            <a href="{{ route('tasks.destroy', $task) }}"
                               data-method="delete"
                               rel="nofollow"
                               data-confirm="Are you sure?">Remove</a>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
@endsection
