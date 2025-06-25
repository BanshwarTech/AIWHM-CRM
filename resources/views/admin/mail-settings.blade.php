@extends('admin.inc.layouts')
@section('parentMenu', 'settings')
@section('page-title', 'Mail Settings')
@section('admin-content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-black">Mail settings</h4>
            <form action="{{ route('admin.mail.settings.update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="mail_mailer">Mailer</label>
                            <input class="form-control" id="mail_mailer" name="mail_mailer" type="text"
                                value="{{ $data->mail_mailer ?? '' }}" placeholder="Enter Mailer">
                            @error('mail_mailer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="mail_scheme">Scheme</label>
                            <input class="form-control" id="mail_scheme" name="mail_scheme" type="text"
                                value="{{ $data->mail_scheme ?? '' }}" placeholder="Enter Scheme"> @error('mail_scheme')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="mail_host">Host</label>
                            <input class="form-control" id="mail_host" name="mail_host" type="text"
                                value="{{ $data->mail_host ?? '' }}" placeholder="Enter Host">
                            @error('mail_host')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="mail_port">Port</label>
                            <input class="form-control" id="mail_port" name="mail_port" type="text"
                                value="{{ $data->mail_port ?? '' }}" placeholder="Enter Port">
                            @error('mail_port')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="mail_username">Username</label>
                            <input class="form-control" id="mail_username" name="mail_username" type="text"
                                value="{{ $data->mail_username ?? '' }}" placeholder="Enter Username">
                            @error('mail_username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="mail_password">Password</label>
                            <div class="input-group">
                                <input class="form-control" id="mail_password" name="mail_password" type="password"
                                    value="{{ $data->mail_password ?? '' }}" placeholder="Enter Password">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword()">
                                        <i class="fa fa-eye" id="togglePasswordIcon" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                            @error('mail_password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="col-lg-6">
                        <fieldset class="form-group">
                            <label for="mail_from_address">From Address</label>
                            <input class="form-control" id="mail_from_address" name="mail_from_address" type="email"
                                value="{{ $data->mail_from_address ?? '' }}" placeholder="Enter From Address">
                            @error('mail_from_address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="col-lg-6">
                        <fieldset class="form-group">
                            <label for="mail_from_name">From Name</label>
                            <input class="form-control" id="mail_from_name" name="mail_from_name" type="text"
                                value="{{ $data->mail_from_name ?? '' }}" placeholder="Enter From Name">
                        </fieldset>
                    </div>
                </div>


                <button type="submit" class="btn btn-success btn-sm">Update</button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function togglePassword() {
                const passwordInput = document.getElementById("mail_password");
                const icon = document.getElementById("togglePasswordIcon");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    passwordInput.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            }
        </script>
    @endpush
@endsection
