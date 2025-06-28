@extends('admin.inc.layouts')

@section('parentMenu', 'Tasks')
@section('page-title', 'Manage Tasks')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-black">{{ isset($task) ? 'Update ' : 'Create ' }} Task</h4>

            <form class="form-horizontal form-material" action="{{ route('manage.tasks.create', $task->id ?? '') }}"
                method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label class="form-label">Task Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Task Title"
                            value="{{ $task->title ?? '' }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-2">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" placeholder="Task Description">{{ $task->description ?? '' }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Assign To</label>
                        <select class="form-control" name="user_id">
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ ($task->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="pending" {{ ($task->status ?? '') == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="in_progress" {{ ($task->status ?? '') == 'in_progress' ? 'selected' : '' }}>In
                                Progress
                            </option>
                            <option value="completed" {{ ($task->status ?? '') == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" value="{{ $task->start_date ?? '' }}">
                        @error('start_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" class="form-control" name="due_date" value="{{ $task->due_date ?? '' }}">
                        @error('due_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12">
                        <button class="btn btn-success">{{ isset($task) ? 'Update ' : 'Create ' }} Task</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
