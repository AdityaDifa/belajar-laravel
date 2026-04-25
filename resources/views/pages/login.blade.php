@extends('master')

@push('styles')
<style>
    .register-container {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    .register-form {
        width: 50%;
        background-color: white;
        border-radius: 4px;
        border: 1px solid #B33791;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .input-form {
        display: flex;
        flex-direction: column;
    }
</style>
@endpush

@section('content')
<div class="register-container">
    <form action="{{ route('authenticate') }}" method="POST" class="register-form">
        @csrf
        <h1 style="text-align: center;">Login Form</h1>

        <div class="input-form">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="email" maxlength="255">
        </div>

        <div class="input-form">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="password" maxlength="255">
                <button class="btn btn-outline-secondary" style="width: 70px;" type="button" id="togglePassword">
                    Show
                </button>
            </div>
        </div>

        <div>
            <div style="border-top: 1px solid black;margin:2px 0"></div>
            <p style="font-size: 12px;color:red;">
                *Bilamana anda lupa password, hubungi admin karena sistem belum memiliki fitur forget password
            </p>
        </div>

        <button class="btn btn-primary" type="submit">Login</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $('#togglePassword').on('click', function() {
        let passwordField = $('#password');
        let isPassword = passwordField.attr('type') === "password";

        // Toggle tipe input
        passwordField.attr('type', isPassword ? 'text' : 'password');

        // Toggle teks tombol
        $(this).text(isPassword ? 'Hide' : 'Show');
    });
</script>

@endpush