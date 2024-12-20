<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            width: 350px;
            padding: 40px;
            position: relative;
            background: #fff;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .login-box h1 {
            margin: 0 0 30px;
            padding: 0;
            color: #333;
            font-size: 24px;
        }

        .textbox {
            position: relative;
            margin-bottom: 30px;
        }

        .textbox i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #333;
        }

        .textbox input {
            width: calc(100% - 20px);
            padding: 10px 10px 10px 10px; /* Increased left padding to create space for icon */
            border: 1px solid #ccc;
            background: #f2f2f2;
            outline: none;
            color: #333;
            border-radius: 4px;
            font-size: 16px;
            text-align: center; /* This will center the placeholder text */
        }

        .textbox input::placeholder {
            color: #aaa;
        }

        .button {
            width: 100%;
            background: #FF5733;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 18px;
            color: #fff;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .button:hover {
            background: #e14a2d;
        }
    </style>
</head>

<body>
    <form action="validate.php" method="post">
        <div class="login-box">
            <h1>Login</h1>

            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Username" name="username" value="">
            </div>

            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Password" name="password" value="">
            </div>

            <input class="button" type="submit" name="login" value="Sign In">
        </div>
    </form>
</body>

</html>
