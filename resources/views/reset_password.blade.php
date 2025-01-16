<!-- resources/views/reset_password.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background-color: #45a049;
        }

        span {
            color: red;
            display: block;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <form method="POST" action="{{ route('resetPassword') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="password">New Password:</label>
        <input type="password" name="password" required>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
        @error('password_confirmation')
            <span>{{ $message }}</span>
        @enderror
        <button type="submit">Reset Password</button>
    </form>
</body>

</html>
