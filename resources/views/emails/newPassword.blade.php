<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change password</title>
</head>
<body>
<span>To change your password please follow the link: </span>
<a class="btn btn-secondary" role="button" href="{{ route('newPasswordForm', $passwordReset->token) }}">Change password</a>
<br>
<span>If you did not leave a request to change your password, ignore this letter.</span>
</body>
</html>
