@extends('layouts.app')

@section('task', 'active')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.show_tasks_title') }}: {{App\User::find($task->created_by_id)->name}}</h1>
        <p>{{ __('tasks.description') }}: {{$task->description}}</p>
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>{{ __('tasks.status') }}</th>
                <th>{{ __('tasks.name') }}</th>
                <th>{{ __('tasks.creator') }}</th>
                <th>{{ __('tasks.assignee') }}</th>
                <th>{{ __('tasks.created_at') }}</th>
                <th>{{ __('tasks.labels') }}</th>
                @if (Auth::check())
                    <th>{{ __('tasks.actions') }}</th>
                @endif
            </tr>
            </thead>
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{App\TaskStatus::find($task->status_id)->name}}</td>
                    <td><a href="{{ route('tasks.show', $task) }}">{{$task->name}}</a></td>
                    <td>{{App\User::find($task->created_by_id)->name}}</td>
                    <td>{{$task->assigned_to_id ? App\User::find($task->assigned_to_id)->name : ""}}</td>
                    <td>{{$task->created_at}}</td>
                    <td>
                    @foreach ($labels as $label)
                        {{$label->name . " "}}
                    @endforeach
                    </td>
                    @if (Auth::check())
                        <td><a href="{{route('tasks.edit', $task)}}">{{ __('tasks.edit') }}</a>
                            @if (auth()->user()->id === $task->created_by_id)
                                <a href="{{ route('tasks.destroy', $task) }}"
                                   data-method="delete"
                                   rel="nofollow"
                                   data-confirm="{{ __('tasks.are_you_sure') }}">{{ __('tasks.remove') }}</a>
                            @endif
                        </td>
                    @endif
                </tr>
        </table>
    </div>
@endsection
