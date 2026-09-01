<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Omah Dekorasi Klaten</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Figtree', Arial, sans-serif;
            background: #f4f5f7;
            color: #374151;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.10);
            overflow: hidden;
        }

        .login-top {
            height: 6px;
            background: #4f46e5;
        }

        .login-content {
            padding: 38px 40px 40px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-title h1 {
            margin: 0;
            font-size: 25px;
            font-weight: 700;
            color: #4f46e5;
        }

        .login-title p {
            margin: 8px 0 0;
            font-size: 14px;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .form-input {
            width: 100%;
            height: 44px;
            padding: 0 13px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #ffffff;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .form-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(18, 7, 219, 0.12);
        }

        .remember {
            display: flex;
            align-items: center;
            margin-top: 2px;
            margin-bottom: 25px;
        }

        .remember input {
            width: 16px;
            height: 16px;
            margin: 0 8px 0 0;
            accent-color: #4f46e5;
        }

        .remember label {
            font-size: 14px;
            color: #6b7280;
            cursor: pointer;
        }

        .login-button {
            width: 100%;
            height: 44px;
            border: none;
            border-radius: 8px;
            background: #4f46e5;
            color: white;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-button:hover {
            background: #4f46e5;
        }

        .login-button:active {
            transform: translateY(1px);
        }

        .login-footer {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
            color: #9ca3af;
        }

        .error-message {
            margin-top: 6px;
            font-size: 13px;
            color: #dc2626;
        }

        @media (max-width: 480px) {
            .login-content {
                padding: 30px 25px 32px;
            }

            .login-title h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-page">

        <div class="login-wrapper">

            <div class="login-card">

                <div class="login-top"></div>

                <div class="login-content">

                    {{ $slot }}

                </div>

            </div>

            <div class="login-footer">
                © {{ date('Y') }} Omah Dekorasi Klaten
            </div>

        </div>

    </div>

</body>

</html>
