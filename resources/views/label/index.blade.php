@extends('layouts.app')

@section('label', 'active')
@section('content')
    <div class="container">
            <h1 class="mb-5">Labels</h1>
            @if (Auth::check())
                <a href="{{route('labels.create')}}" class="btn btn-primary mb-1">Add New</a>
            @endif
            <table class="table table-bordered table-hover text-nowrap">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created at</th>
                    @if (Auth::check())
                        <th>Actions</th>
                    @endif
                </tr>
                </thead>
                @foreach ($labels as $label)
                    <tr>
                        <td>{{$label->id}}</td>
                        <td>{{$label->name}}</td>
                        <td>{{$label->created_at}}</td>
                        @if (Auth::check())
                            <td><a href="{{route('labels.edit', $label)}}">Edit</a>
                                <a href="{{ route('labels.destroy', $label) }}"
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
