@extends('admin.inc.layouts')

@section('parentMenu', 'Profile')
@section('page-title', 'Manage Profile')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-black">Update Profile</h4>

            <form class="form-horizontal form-material" action="{{ route('profile.insert') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control form-control-line" placeholder="" name="name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="example-email" class="form-label">Email</label>
                        <input type="email" id="example-email" name="email" class="form-control form-control-line" placeholder="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Role</label>
                        <select class="form-control form-control-line" name="role">
                            <option value="">-- Select Role --</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Phone No</label>
                        <input type="text" class="form-control form-control-line" name="phone" placeholder="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control form-control-line" value="" name="password">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control form-control-line" value="" name="address">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-success">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
