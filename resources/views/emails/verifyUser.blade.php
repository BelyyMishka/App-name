<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm your email</title>
</head>
<body>
<span>To confirm your email please follow the link: </span>
<a class="btn btn-secondary" role="button" href="{{ route('verify.verify', $userVerify->token) }}">Confirm</a>
</body>
</html>
