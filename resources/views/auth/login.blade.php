<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('login/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/iofrm-style.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/iofrm-theme33.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .form-items {
            display: none;
        }

        .form-items.active {
            display: block;
        }

        .invalid-feedback {
            margin-top: -14px;
            margin-bottom: 14px;
            color: red;
        }
    </style>
</head>

<body>

    <div class="form-body">
        <div class="iofrm-layout">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('graphic10.svg') }}" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">

                    <!-- LOGIN FORM -->
                    <div class="form-items with-bg active" id="login-form">
                        <div class="logo pb-1">
                            <img class="w-75" src="{{ asset('black.png') }}" alt="">
                        </div>
                        <h3 class="font-md">Login</h3>
                        <p>Please enter your credentials to login.</p>
                        <form id="login-form-submit" method="POST">
                            @csrf
                            <input type="hidden" name="form_type" value="login">
                            <input class="form-control" type="email" name="email" placeholder="E-mail">
                            <div class="invalid-feedback" id="email-error"></div>
                            <input class="form-control" type="password" name="password" placeholder="Password">
                            <div class="invalid-feedback" id="password-error"></div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>

                    <!-- OTP FORM -->
                    <div class="form-items with-bg" id="otp-form">
                        <div class="logo pb-1">
                            <img class="w-75" src="{{ asset('black.png') }}" alt="">
                        </div>
                        <h3 class="font-md">Verify OTP</h3>
                        <p>Please enter the OTP sent to your email.</p>
                        <form id="otp-form-submit" method="POST">
                            @csrf
                            <input type="hidden" name="form_type" value="otp">
                            <input type="hidden" name="email" id="otp-email">
                            <input class="form-control" type="text" name="otp" placeholder="Enter OTP">
                            <div class="invalid-feedback" id="otp-error"></div>
                            <button type="submit" class="btn btn-success mt-2">Verify OTP</button>
                            <a href="#" class="btn btn-link" onclick="resendOtp(event)">Resend OTP</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('login/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Login submit
            $('#login-form-submit').submit(function(e) {
                e.preventDefault();

                // Change button text and disable it
                const loginBtn = $(this).find('button[type="submit"]');
                const originalText = loginBtn.text();
                loginBtn.text('Processing...').prop('disabled', true);

                $.post('{{ route('login.post') }}', $(this).serialize(), function(res) {
                    if (res.success) {
                        toastr.success(res.message);
                        $('#login-form').removeClass('active');
                        $('#otp-form').addClass('active');
                        $('#otp-email').val(res.email);
                    } else {
                        toastr.error(res.message);
                        $('#email-error').text(res.errors?.email || '');
                        $('#password-error').text(res.errors?.password || '');
                    }
                }).fail(function(xhr) {
                    toastr.error('Login failed');
                }).always(function() {
                    // Re-enable button
                    loginBtn.text(originalText).prop('disabled', false);
                });
            });


            // OTP submit
            $('#otp-form-submit').submit(function(e) {
                e.preventDefault();
                $.post('{{ route('login.post') }}', $(this).serialize(), function(res) {
                    if (res.success) {
                        toastr.success(res.message);
                        window.location.href = res.redirect;
                    } else {
                        toastr.error(res.message);
                        $('#otp-error').text(res.errors?.otp || '');
                    }
                }).fail(function(xhr) {
                    toastr.error('OTP failed');
                });
            });
        });

        function resendOtp(e) {
            e.preventDefault();
            $.post('{{ route('login.post') }}', {
                _token: '{{ csrf_token() }}',
                form_type: 'resend_otp',
                email: $('#otp-email').val()
            }, function(res) {
                toastr.success(res.success || 'OTP resent');
            }).fail(function() {
                toastr.error('Failed to resend OTP');
            });
        }
    </script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if ($errors->any())
            toastr.error("{{ $errors->first() }}");
        @endif
    </script>

</body>

</html>
