<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh; /* Make the body take up the entire viewport height */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #292930;
        }

        .top-right {
            position: absolute;
            top: 20px;
            right: 40px;
            font-size: 1.3em;
            color: #fff;
            text-decoration: none
        }

        p#real-time-clock {
            font-size: 7em;
            font-weight: 900;
            font-family: math;
            color: #fff;
        }
    </style>
</head>
<body>
    <a class="top-right" href={{route('login')}}>Login</a>
    <p id="real-time-clock">{{ now() }}</p>
    <script src="{{ 'assets/js/real-time-clock.js' }}"></script>
</body>
</html>
