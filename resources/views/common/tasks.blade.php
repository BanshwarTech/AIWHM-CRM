@extends('admin.inc.layouts')

@section('parentMenu', 'Tasks')
@section('page-title', 'Tasks')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-black">Tasks</h4>
            <p>Manage your tasks efficiently</p>
            <div class="table-responsive">
                <table id="taskTable" class="table table-striped" data-name="cool-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Title</th>
                            <th>Description</th>
                            <th>Assign To</th>
                            <th>Timeline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $index => $task)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->user->name }}</td>
                                <td>{{ $task->start_date }} - {{ $task->due_date }}</td>
                                <td>{{ $task->status }}</td>
                                <td>
                                    <a href="{{ route('admin.manage.tasks', $task->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>

                                    <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID </th>
                            <th>Task Title</th>
                            <th>Description</th>
                            <th>Assign To</th>
                            <th>Timeline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#taskTable').DataTable({
                    "responsive": true,
                    "autoWidth": false,
                    "lengthMenu": [10, 25, 50, 100],
                    "order": [
                        [0, 'desc']
                    ],
                });
            });
        </script>
    @endpush
@endsection
