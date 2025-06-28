@extends('admin.inc.layouts')

@section('parentMenu', 'Profile')
@section('page-title', 'Manage Profile')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-black">{{ isset($users) ? 'Update' : 'Create' }} Profile</h4>

            <form class="form-horizontal form-material" action="{{ route('manage.profiles.create') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="text" class="form-control form-control-line" placeholder="Enter Full Name" name="id"
                            value="{{ $users->id ?? '' }}" hidden>
                    <div class="col-md-12 mb-2">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control form-control-line" placeholder="Enter Full Name" name="name"
                            value="{{ $users->name ?? '' }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Role</label>
                        <select class="form-control form-control-line" name="role">
                            <option value="">-- Select Role --</option>
                            <option value="admin" {{ ($users->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="team-leader" {{ ($users->role ?? '') == 'team-leader' ? 'selected' : '' }}>Team
                                Leader</option>
                            <option value="team-member" {{ ($users->role ?? '') == 'team-member' ? 'selected' : '' }}>Team
                                Member</option>
                        </select>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Phone No</label>
                        <input type="text" class="form-control form-control-line" value="{{ $users->phone ?? '' }}" name="phone" placeholder="Enter Phone No">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="example-email" class="form-label">Email</label>
                        <input type="email" id="example-email" name="email" value="{{ $users->email ?? '' }}" class="form-control form-control-line"
                            placeholder="Enter Email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control form-control-line" value="{{ $users->decrypted_password ?? '' }}" placeholder="Enter Password"
                            name="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Department</label>
                        <input type="text" id="example-email" name="department" value="{{ $users->department ?? '' }}" class="form-control form-control-line"
                            placeholder="Enter Department">
                        @error('department')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Position</label>
                        <input type="text" class="form-control form-control-line" value="{{ $users->position ?? '' }}" placeholder="Enter Position"
                            name="position">
                        @error('position')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control form-control-line" name="address" placeholder="Enter Address">{{ $users->address ?? '' }}</textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-success btn-sm">{{ isset($users) ? 'Update' : 'Create' }} Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection