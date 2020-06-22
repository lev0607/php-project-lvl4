@extends('layouts.app')

@section('task', 'active')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.tasks_title') }}</h1>
        @auth
            <a href="{{route('tasks.create')}}" class="btn btn-primary mb-2">{{ __('tasks.add') }}</a>
        @endauth
        <form method="GET" action="?" accept-charset="UTF-8" class="form-inline mb-2">
            <select class="form-control mr-2" name="filter[status_id]">
                <option value="">{{ __('tasks.status') }}</option>
                @foreach ($taskStatuses as $taskStatus)
                    <option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
                @endforeach
            </select>
            <select class="form-control mr-2" name="filter[created_by_id]">
                <option value="">{{ __('tasks.creator') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <select class="form-control mr-2" name="filter[assigned_to_id]">
                <option value="">{{ __('tasks.assignee') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <select class="form-control mr-2" name="filter[labels.name]">
                <option value="">{{ __('tasks.labels') }}</option>
                @foreach ($labels as $label)
                    <option value="{{ $label->name }}">{{ $label->name }}</option>
                @endforeach
            </select>
            <input class="btn btn-outline-primary mr-2" type="submit" value="{{ __('tasks.apply') }}">
        </form>
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="thead-dark">
            <tr>
                <th>{{ __('tasks.id') }}</th>
                <th>{{ __('tasks.status') }}</th>
                <th>{{ __('tasks.name') }}</th>
                <th>{{ __('tasks.creator') }}</th>
                <th>{{ __('tasks.assignee') }}</th>
                <th>{{ __('tasks.labels') }}</th>
                <th>{{ __('tasks.created_at') }}</th>
                @auth
                    <th>{{ __('tasks.actions') }}</th>
                @endauth
            </tr>
            </thead>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{isset($task->status->name) ? $task->status->name : ''}}</td>
                    <td><a href="{{ route('tasks.show', $task) }}">{{$task->name}}</a></td>
                    <td>{{$task->user->name}}</td>
                    <td>{{$task->assigned_to_id ? $task->assigned->name : ''}}</td>
                    <td>
                        @foreach ($task->labels()->get() as $label)
                            {{$label->name . " "}}
                        @endforeach
                    </td>
                    <td>{{$task->created_at}}</td>
                    @auth
                        <td><a href="{{route('tasks.edit', $task)}}">{{ __('tasks.edit') }}</a>
                            @can('delete', $task)
                            <a href="{{ route('tasks.destroy', $task) }}"
                               data-method="delete"
                               rel="nofollow"
                               data-confirm="{{ __('tasks.are_you_sure') }}">{{ __('tasks.remove') }}</a>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>
    </div>
@endsection
