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

@push('styles')
    <style>
        .profile-card {
            border-radius: 12px;
        }

        .profile-cover-img {
            border-radius: 12px;
        }

        .profile-avatar {
            transform: translate(-50%, -50%) !important;
            left: 50%;
        }

        .profile-info-container {
            padding-top: 3rem;
        }

        .profile-info p {
            margin-bottom: 0;
        }

        .card-with-border {
            border-radius: 12px;
            border-top: 4px solid;
            border-color: var(--bs-primary);
            margin-top: 25px !important;
        }

        .info-list-item {
            margin-bottom: 10px;
            font-size: 13px;
        }

        .info-list-item p {
            margin-left: 1rem;
            margin-bottom: 0;
        }

        .section-card {
            border-radius: 12px;
            margin-top: 25px !important;

        }



        .password-wrapper {
            position: relative;
        }



        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            user-select: none;
        }
    </style>
@endpush

@section('parentMenu', 'Profile')
@section('page-title', 'My Profile')

@section($content)

    <div class="card profile-card">
        <div class="card-body p-4">
            <div class="position-relative mb-5">
                <img src="assets/images/gallery/profile-cover.png" class="img-fluid profile-cover-img shadow" alt="">
                <div class="profile-avatar position-absolute top-100 start-50 translate-middle">
                    @if ($user->profile_image)
                        <img src="{{ asset('uploads/profile_images/' . $user->profile_image) }}"
                            class="img-fluid rounded-circle p-1 bg-grd-danger shadow" width="170" height="170"
                            alt="">
                    @else
                        <img src="{{ asset('user-icon.webp') }}" class="img-fluid rounded-circle p-1 bg-grd-danger shadow"
                            width="170" height="170" alt="">
                    @endif
                </div>
            </div>
            <div class="profile-info profile-info-container d-flex align-items-center justify-content-between">
                <div>
                    <h3 style="color: #000;font-weight:bold;">{{ $user->name }}</h3>
                    <p>{{ $user->department }}</p>
                    <p>{{ $user->position }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card card-with-border border-gradient-1">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <h5 class="mb-0 fw-bold">My Profile</h5>
                    </div>
                    <form class="form-horizontal form-material" action="{{ route('my.profile.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $profile->id }}">
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control form-control-line" name="name"
                                    placeholder="Enter Full Name" value="{{ $profile->name ?? '' }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control form-control-line" name="email"
                                    placeholder="Enter Email" value="{{ $profile->email }}" disabled>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control form-control-line" name="phone"
                                    placeholder="Enter Phone" value="{{ $profile->phone }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">-- Select Gender --</option>
                                    <option value="male"
                                        {{ old('gender', $profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female"
                                        {{ old('gender', $profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="other"
                                        {{ old('gender', $profile->gender ?? '') == 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control form-control-line"
                                    value="{{ $profile->dob }}">
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Department -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control form-control-line"
                                    value="{{ $profile->department }}" disabled>
                                @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Position -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Position</label>
                                <input type="text" name="position" class="form-control form-control-line"
                                    value="{{ $profile->position }}" disabled>
                                @error('position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-control" disabled>
                                    <option value="">-- Select Role --</option>
                                    <option value="admin"
                                        {{ old('role', $profile->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="team-leader"
                                        {{ old('role', $profile->role ?? '') == 'team-leader' ? 'selected' : '' }}>Team
                                        Leader</option>
                                    <option value="team-member"
                                        {{ old('role', $profile->role ?? '') == 'team-member' ? 'selected' : '' }}>Team
                                        Member</option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control form-control-line">{{ $profile->address }}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Profile Image -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Profile Image</label>
                                <input type="file" name="profile_image" class="form-control form-control-line">
                                @error('profile_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-success btn-sm">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card section-card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <h5 class="mb-0 fw-bold">About</h5>
                    </div>
                    <div class="info-list d-flex flex-column ">
                        <div class="info-list-item d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="10" r="3" />
                                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                            </svg>
                            <p>Full Name: {{ $user->name }}</p>
                        </div>
                        <div class="info-list-item d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-check-icon lucide-check">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                            <p>Status: {{ $user->is_active }}</p>
                        </div>
                        <div class="info-list-item d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-code-icon lucide-code">
                                <path d="m16 18 6-6-6-6" />
                                <path d="m8 6-6 6 6 6" />
                            </svg>
                            <p>Role: {{ $user->role }}</p>
                        </div>
                        <div class="info-list-item d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-send-horizontal-icon lucide-send-horizontal">
                                <path
                                    d="M3.714 3.048a.498.498 0 0 0-.683.627l2.843 7.627a2 2 0 0 1 0 1.396l-2.842 7.627a.498.498 0 0 0 .682.627l18-8.5a.5.5 0 0 0 0-.904z" />
                                <path d="M6 12h16" />
                            </svg>
                            <p>Email: {{ $user->email }}</p>
                        </div>
                        <div class="info-list-item d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone">
                                <path
                                    d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                            </svg>
                            <p>Phone: {{ $user->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card section-card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <h5 class="mb-0 fw-bold">Update Password</h5>
                    </div>
                    <form action="{{ route('password.update') }}" method="POST" class="row">
                        @csrf
                        @method('PUT')

                        <div class="col-12 mb-3">
                            <label class="form-label">Old Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="old_password" class="form-control password-input"
                                    placeholder="Enter Old Password">
                                <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                            </div>
                            @error('old_password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">New Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="new_password" class="form-control password-input"
                                    placeholder="Enter New Password">
                                <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                            </div>
                            @error('new_password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="new_password_confirmation"
                                    class="form-control password-input" placeholder="Confirm New Password">
                                <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                            </div>
                            @error('new_password_confirmation')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-sm">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".toggle-password").forEach(toggle => {
                    toggle.addEventListener("click", function() {
                        const input = this.closest(".password-wrapper").querySelector(
                            ".password-input");

                        if (input.type === "password") {
                            input.type = "text";
                            this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
                        } else {
                            input.type = "password";
                            this.innerHTML = '<i class="fa-solid fa-eye"></i>';
                        }
                    });
                });
            });
        </script>
    @endpush

@endsection
