@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Add new label</h1>
        {{ Form::model($label, ['url' => route('labels.store')]) }}
            @include('label.form')
            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
