<!DOCTYPE HTML> <html lang="en"> <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}"> <title>Admin Login</title> <style> body { font-family: 'Arial' ,
    sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; display: flex; flex-direction:column-reverse; gap:4rem; justify-content: center; align-items:
    center; height: 100vh; } form { max-width: 400px; margin: 0 auto; background-color: #fff; padding: 30px; box-shadow:
    0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; } label { font-weight: bold; display: block; margin-bottom: 10px;
    font-size: 14px; } input { width: 100%; padding: 12px; margin-bottom: 20px; box-sizing: border-box; border: 1px
    solid #ccc; border-radius: 5px; font-size: 14px; } .eye-container { position: relative; margin-bottom: 20px; }
    .eye-icon { display: inline-block; cursor: pointer; position: absolute; top: 50%; transform: translate(0, -50%);
    right: 10px; z-index: 1; } .submit-btn { background-color: #3498db; color: #fff; padding: 12px 20px; border: none;
    border-radius: 5px; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease; } .submit-btn:hover {
    background-color: #2980b9; } .alert { margin-top: 20px; padding: 15px; border-radius: 5px; } .alert-success {
    background-color: #d4edda; color: #155724; } .alert-danger { background-color: #f8d7da; color: #721c24; } a { color:
    #3498db; } a:hover { color: #2980b9; } </style>
</head>

<body>

    <form method="post" action="{{ route('admin.login') }}">
        @csrf

        <label for="email">User E-mail:</label>
        <input type="text" name="email" required>
        @if($errors->has('email'))
       
           {{ $errors->first('email') }}
        
        @endif

        <label for="password">User Password:</label>
        <div class="eye-container">
            <input type="password" name="password" id="password" required>
            <span class="eye-icon" onclick="togglePassword('password')">👁️</span>
        </div>
        @if ($errors->has('password'))
       
            {{ $errors->first('password') }}
       
        @endif

        <input type="submit" name="submit" class="submit-btn" value="Login Here!!!">
        <a href="{{route('forget.password')}}">forget password???</a>
    </form>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    </script>

    @if(session('success'))
   
        {{ session('success') }}
    
    @endif

    @if(session('fail'))
    
       {{ session('fail') }}
   
    @endif

</body>

</html>