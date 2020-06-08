@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.create_labels_title') }}</h1>
        {{ Form::model($label, ['url' => route('labels.store')]) }}
            @include('label.form')
            {{ Form::submit(__('tasks.create'), ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
