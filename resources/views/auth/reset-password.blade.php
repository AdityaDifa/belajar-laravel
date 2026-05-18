<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="shortcut icon" href="{{ asset('images/icons/icon-gudang-clipper.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/theme-variable.css')  }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        body {
            background-color: var(--main);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            padding: 20px;
            display: flex;
            justify-content: center;
            background-color: white;
            flex-direction: column;
            gap: 8px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <h1>
            Reset Your Password
        </h1>
        <input type="hidden" name="token" value="{{ $token }}" />
        <input type="hidden" name="email" value="{{ $email }}" />

        {{-- Tampilan saja, tidak dikirim --}}
        <input type="email" value="{{ $email }}" readonly
            style="background:#f0f0f0; cursor:not-allowed;" />

        <input id="password" type="password" name="password" placeholder="Password baru" required minlength="8"/>
        <p id="alert_length" class="error-text mt-1" style="display:none;margin:0">Password must be at least 8 characters long.</p>

        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Konfirmasi password" required minlength="8">
        <p id="alert_match" class="error-text mt-1" style="display:none;margin:0">Passwords do not match.</p>

        <button type="submit" class="btn btn-primary" id="btnSubmit">Reset Password</button>

        @error('email') <span>{{ $message }}</span> @enderror
    </form>
</body>

<script>
    $(document).ready(function(){
        function validatePasswords() {
            let password = $('#password').val();
            let confirmPassword = $('#password_confirmation').val();
            let isValid = true;

            // 1. Validasi Panjang Karakter Password Utama
            if (password.length > 0 && password.length < 8) {
                $('#alert_length').fadeIn();
                isValid = false;
            } else {
                $('#alert_length').fadeOut();
            }

            // 2. Validasi Kecocokan (Hanya muncul jika konfirmasi password sudah mulai diisi)
            if (confirmPassword.length > 0 && password !== confirmPassword) {
                $('#alert_match').fadeIn();
                isValid = false;
            } else {
                $('#alert_match').fadeOut();
            }

            // Bonus: Mengunci tombol submit jika tidak valid
            if (isValid && password.length >= 8 && confirmPassword.length >= 8) {
                $('#btnSubmit').prop('disabled', false);
            } else {
                $('#btnSubmit').prop('disabled', true);
            }
        }

        // Jalankan fungsi validasi setiap kali user mengetik di kedua input tersebut
        $('#password, #password_confirmation').on('input', function(){
            validatePasswords();
        });
    });
</script>

</html>