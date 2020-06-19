@extends('layouts.app')

@section('taskStatus', 'active')
@section('content')
    <div class="container">
            <h1 class="mb-5">{{ __('tasks.status_title') }}</h1>
            @auth
                <a href="{{route('task_statuses.create')}}" class="btn btn-primary mb-1">{{ __('tasks.add') }}</a>
            @endauth
            <table class="table table-bordered table-hover text-nowrap">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('tasks.id') }}</th>
                    <th>{{ __('tasks.name') }}</th>
                    <th>{{ __('tasks.created_at') }}</th>
                    @auth
                        <th>{{ __('tasks.actions') }}</th>
                    @endauth
                </tr>
                </thead>
                @foreach ($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{$taskStatus->id}}</td>
                        <td>{{$taskStatus->name}}</td>
                        <td>{{$taskStatus->created_at}}</td>
                        @auth
                            <td><a href="{{route('task_statuses.edit', $taskStatus)}}">{{ __('tasks.edit') }}</a>
                                <a href="{{ route('task_statuses.destroy', $taskStatus) }}"
                                   data-method="delete"
                                   rel="nofollow"
                                   data-confirm="{{ __('tasks.are_you_sure') }}">{{ __('tasks.remove') }}</a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </table>
    </div>
@endsection
