@php
    $role = session('USER_ROLE');
    $layout = match ($role) {
        'admin' => 'admin.inc.layouts',
        'team-leader' => 'team-leader.inc.layout',
        'team-member' => 'team-member.inc.layout',
    };
    $content = match ($role) {
        'admin' => 'admin-content',
        'team-leader' => 'teamleader-content',
        'team-member' => 'teammember-content',
    };
@endphp

@extends($layout)

@section('parentMenu', 'Tasks')
@section('page-title', 'Tasks')

@section($content)
    <div class="card">
        <div class="card-header " style="background: #ddd;padding:10px 16px 0px 16px">
            <h5 class="text-black fw-bold"> Tasks</h5>
        </div>
        <div class="card-body">
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
                                    <a href="{{ route('tasks.view', $task->id) }}"class="btn btn-sm btn-info"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-eye text-white">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg></a> ||

                                    <a href="{{ route('manage.tasks', $task->id) }}" class="btn btn-sm btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-edit text-white">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a> ||

                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash-2 text-white">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></button>
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
