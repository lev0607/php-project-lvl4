@extends('layouts.app')

@section('taskStatus', 'active')
@section('content')
    <div class="container">
            <h1 class="mb-5">{{ __('tasks.status_title') }}</h1>
            @if (Auth::check())
                <a href="{{route('task_statuses.create')}}" class="btn btn-primary mb-1">{{ __('tasks.add') }}</a>
            @endif
            <table class="table table-bordered table-hover text-nowrap">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>{{ __('tasks.name') }}</th>
                    <th>{{ __('tasks.created_at') }}</th>
                    @if (Auth::check())
                        <th>{{ __('tasks.actions') }}</th>
                    @endif
                </tr>
                </thead>
                @foreach ($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{$taskStatus->id}}</td>
                        <td>{{$taskStatus->name}}</td>
                        <td>{{$taskStatus->created_at}}</td>
                        @if (Auth::check())
                            <td><a href="{{route('task_statuses.edit', $taskStatus)}}">{{ __('tasks.edit') }}</a>
                                <a href="{{ route('task_statuses.destroy', $taskStatus) }}"
                                   data-method="delete"
                                   rel="nofollow"
                                   data-confirm="{{ __('tasks.are_you_sure') }}">{{ __('tasks.remove') }}</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
    </div>
@endsection
