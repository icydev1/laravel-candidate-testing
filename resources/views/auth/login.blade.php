<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Candidate Testing</title>
</head>
<body>
    
    <!-- Login Form -->
    <form method="POST" action="{{ route('client-login') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required value="{{ old('email') }}">
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
