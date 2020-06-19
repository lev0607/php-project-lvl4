@extends('layouts.app')

@section('task', 'active')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.show_tasks_title') }}: {{$task->name}}</h1>
        <p>{{ __('tasks.description') }}: {{$task->description}}</p>
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="thead-dark">
            <tr>
                <th>{{ __('tasks.id') }}</th>
                <th>{{ __('tasks.status') }}</th>
                <th>{{ __('tasks.name') }}</th>
                <th>{{ __('tasks.creator') }}</th>
                <th>{{ __('tasks.assignee') }}</th>
                <th>{{ __('tasks.created_at') }}</th>
                <th>{{ __('tasks.labels') }}</th>
                @auth
                    <th>{{ __('tasks.actions') }}</th>
                @endauth
            </tr>
            </thead>
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$taskStatusName}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$taskCreator}}</td>
                    <td>{{$taskAssigned}}</td>
                    <td>{{$task->created_at}}</td>
                    <td>
                    @foreach ($labels as $label)
                        {{$label->name . " "}}
                    @endforeach
                    </td>
                    @auth
                        <td><a href="{{route('tasks.edit', $task)}}">{{ __('tasks.edit') }}</a>
                            @if (auth()->user()->id === $task->created_by_id)
                                <a href="{{ route('tasks.destroy', $task) }}"
                                   data-method="delete"
                                   rel="nofollow"
                                   data-confirm="{{ __('tasks.are_you_sure') }}">{{ __('tasks.remove') }}</a>
                            @endif
                        </td>
                    @endauth
                </tr>
        </table>
    </div>
@endsection
