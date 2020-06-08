@extends('layouts.app')

@section('label', 'active')
@section('content')
    <div class="container">
            <h1 class="mb-5">{{ __('tasks.labels_title') }}</h1>
            @if (Auth::check())
                <a href="{{route('labels.create')}}" class="btn btn-primary mb-1">{{ __('tasks.add') }}</a>
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
                @foreach ($labels as $label)
                    <tr>
                        <td>{{$label->id}}</td>
                        <td>{{$label->name}}</td>
                        <td>{{$label->created_at}}</td>
                        @if (Auth::check())
                            <td><a href="{{route('labels.edit', $label)}}">{{ __('tasks.edit') }}</a>
                                <a href="{{ route('labels.destroy', $label) }}"
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
