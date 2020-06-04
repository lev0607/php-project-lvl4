@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Edit label</h1>
        {{ Form::model($label, ['url' => route('labels.update', $label), 'method' => 'PATCH']) }}
            @include('label.form')
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
