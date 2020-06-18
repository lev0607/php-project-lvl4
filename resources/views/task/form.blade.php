@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif
<div class="form-group">
    {{ Form::label('name', __('tasks.name')) }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('description', __('tasks.description')) }}
    {{ Form::text('description', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('status_id', __('tasks.status')) }}
    <select name="status_id" class="form-control">
        @foreach ($taskStatuses as $taskStatus)
            <option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    {{ Form::label('assigned_to_id', __('tasks.assignee')) }}
    <select name="assigned_to_id" class="form-control">
        <option value="">Assignee</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
</div>
