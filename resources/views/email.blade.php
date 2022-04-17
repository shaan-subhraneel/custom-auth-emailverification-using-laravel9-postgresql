<!-- code developed by Subhraneel Chowdhury -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Please verify your email</title>
</head>
<body>
    Hello {{ $user->name }}, <br/>
    please click <a href="{{ url('/email/'.$user->verifyUser->token) }}">this link</a> to verify your email
</body>
</html>