@php
    $role = session('USER_ROLE');
    $layout = match ($role) {
        'admin' => 'admin.inc.layouts',
        'team-leader' => 'teamleader.inc.layout',
        'team-member' => 'teammember.inc.layout',
    };
    $content = match ($role) {
        'admin' => 'admin-content',
        'team-leader' => 'teamleader-content',
        'team-member' => 'teammember-content',
    };
@endphp

@extends($layout)

@section('parentMenu', 'Profile')
@section('page-title', 'Manage Profile')

@section($content)
    <div class="card">
        <div class="card-body">
            <h4 class="text-black">Create Profile</h4>

            <form class="form-horizontal form-material" action="{{ route('manage.profiles.create') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control form-control-line" placeholder="Enter Full Name"
                            name="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Role</label>
                        <select class="form-control form-control-line" name="role">
                            <option value="">-- Select Role --</option>
                            <option value="admin">Admin</option>
                            <option value="team-leader">Team Leader</option>
                            <option value="team-member">'Team Member</option>
                        </select>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Phone No</label>
                        <input type="text" class="form-control form-control-line" name="phone"
                            placeholder="Enter Phone No">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="example-email" class="form-label">Email</label>
                        <input type="email" id="example-email" name="email" class="form-control form-control-line"
                            placeholder="Enter Email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control form-control-line" placeholder="Enter Password"
                            name="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Department</label>
                        <input type="text" id="example-email" name="department" class="form-control form-control-line"
                            placeholder="Enter Department">
                        @error('department')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Position</label>
                        <input type="text" class="form-control form-control-line" placeholder="Enter Position"
                            name="position">
                        @error('position')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control form-control-line" name="address" placeholder="Enter Address"></textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-success btn-sm">Create Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
