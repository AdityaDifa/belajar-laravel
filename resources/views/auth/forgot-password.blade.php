<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="shortcut icon" href="{{ asset('images/icons/icon-gudang-clipper.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/theme-variable.css')  }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    

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

        form{
            padding:20px;
            display:flex;
            justify-content: center;
            background-color: white;
            flex-direction: column;
            gap:8px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <h1>Forgot Password</h1>

        <input type="email" name="email" placeholder="Your email" required />
        @error('email') <span>{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-primary">Send Reset Link</button>

        @if (session('status'))
        <div>{{ session('status') }}</div>
        @endif
    </form>
</body>

</html>