@extends('layouts.app')

@section('taskStatus', 'active')
@section('content')
    <div class="container">
            <h1 class="mb-5">Task statuses</h1>
            <a href="{{route('task_statuses.create')}}" class="btn btn-primary mb-1">Add New</a>
            <table class="table table-bordered table-hover text-nowrap">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @foreach ($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{$taskStatus->id}}</td>
                        <td>{{$taskStatus->name}}</td>
                        <td>{{$taskStatus->created_at}}</td>
                        <td><a href="{{route('task_statuses.edit', $taskStatus)}}">Edit</a>
                            <a href="{{ route('task_statuses.destroy', $taskStatus) }}"
                               data-method="delete"
                               rel="nofollow"
                               data-confirm="Are you sure?">Remove</a></td>
                    </tr>
                @endforeach
            </table>
    </div>
@endsection
