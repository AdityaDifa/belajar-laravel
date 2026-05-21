@extends('master')

@push('styles')
<style>
    .register-container {
        width: 100%;
        display: flex;
        justify-content: center;
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

    @media(max-width:768px){
        .register-container{
            margin-top:8px;
            
        }

        .register-form{
            width: 100%;
            padding:12px;
            
        }
    }
</style>
@endpush

@section('content')
<div class="register-container">
    <form action="{{ route('register.store') }}" method="POST" class="register-form">
        @csrf
        <h1 style="text-align: center;">Register Form</h1>

        <div class="input-form">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="name" id="username" value="{{ old('name') }}" placeholder="username" maxlength="255">
        </div>

        <div class="input-form">
            <label for="title" class="form-label">Title/ Sebutan</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="title/sebutan(opsional)" maxlength="255">
        </div>

        <div class="input-form">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="email" maxlength="255">
        </div>

        <div class="input-form">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}" placeholder="password" maxlength="255">
                <button class="btn btn-outline-secondary"  type="button" id="togglePassword">
                    Show
                </button>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Register</button>
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