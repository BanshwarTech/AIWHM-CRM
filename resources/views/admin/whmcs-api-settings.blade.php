@extends('admin.inc.layouts')
@section('parentMenu', 'settings')
@section('page-title', 'WHMCS API Settings')
@section('admin-content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-black">WHMCS API settings</h4>
            <form action="{{ route('admin.whmcs.api.settings.update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="api_url">API URL</label>
                            <input class="form-control @error('api_url') is-invalid @enderror" id="api_url"
                                name="whmcs_api_url" type="text" value="{{ old('api_url', $data->api_url ?? '') }}"
                                placeholder="Enter API URL">

                            @error('whmcs_api_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="api_identifier">API Identifier</label>
                            <input class="form-control" id="api_identifier" name="whmcs_api_identifier" type="text"
                                value="{{ $data->api_identifier ?? '' }}" placeholder="Enter API Identifier">
                            @error('whmcs_api_identifier')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="api_secret">API Secret</label>
                            <input class="form-control" id="api_secret" name="whmcs_api_secret" type="text"
                                value="{{ $data->api_secret ?? '' }}" placeholder="Enter API Secret">
                            @error('whmcs_api_secret')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
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
