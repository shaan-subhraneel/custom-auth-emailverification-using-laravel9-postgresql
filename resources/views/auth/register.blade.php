<!-- code developed by Subhraneel Chowdhury -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        .screen{
            height: 100vh;
            justify-content: center;
            align-items: center;
            display: flex;
        }
        .form{
            margin-bottom: 10px;
        }
        .input-box{
            width:50vw;
            height:5vh;
            padding-left:30px;
            border-radius:20px;
        }
    </style>
</head>
<body>
    <div class="screen">
        <div style="display:block;">
            <h2>Register</h2>
            @if(Session::get('fail'))
            <div>{{ Session::get('fail') }}</div>
            @endif

            @if(Session::get('success'))
            <div>{{ Session::get('success') }}</div>
            @endif
            <form action="{{ route('auth.save') }}" method="post">
                @csrf
                <div class="form">
                    <input type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}" class="input-box"/>
                    <span>@error('name'){{ $message }} @enderror</span>
                </div>
                <div class="form">
                    <input type="email" name="email" placeholder="Enter your e-mail" value="{{ old('email') }}" class="input-box"/>
                    <span>@error('email'){{ $message }} @enderror</span>
                </div>
                <div class="form">
                    <input type="password" name="password" placeholder="Enter your password" class="input-box"/>
                    <span>@error('password'){{ $message }} @enderror</span>

                </div>
                <button type="submit" name="submit">Register</button>
            </form>
            <a href="{{ route('auth.login') }}">Already registered? Go to login page</a>
        </div>
    </div>
</body>
</html>