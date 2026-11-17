<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; padding: 20px;
            display: flex; align-items: center; justify-content: center;
            background: #f4f5fb; color: #3b4056;
            font-family: Tahoma, Arial, sans-serif;
        }
        .box {
            width: 100%; max-width: 460px; padding: 32px 28px;
            background: #fff; border-radius: 12px;
            box-shadow: 0 6px 24px rgba(30, 40, 90, .08);
        }
        h1 { font-size: 20px; margin: 0 0 8px; }
        p { margin: 0 0 14px; color: #7b819a; line-height: 1.8; font-size: 14px; }
        input[type=text] {
            width: 100%; padding: 12px; font-size: 20px; letter-spacing: 3px;
            text-align: center; border: 1px solid #d5d8e8; border-radius: 8px;
        }
        .btn {
            width: 100%; padding: 12px; border: 0; border-radius: 8px;
            background: #6259ca; color: #fff; font-size: 15px; cursor: pointer;
        }
        .btn.gray { background: #7b819a; margin-bottom: 10px; }
        .error { color: #e5484d; font-size: 13px; margin: 8px 0; }
        .check { display: flex; align-items: center; gap: 8px; margin: 14px 0; font-size: 14px; }
        .qr { text-align: center; margin: 12px 0; }
        .qr svg { max-width: 200px; height: auto; }
        .key {
            direction: ltr; text-align: center; font-family: monospace; font-size: 13px;
            background: #f4f5fb; padding: 8px; border-radius: 6px; word-break: break-all;
        }
        .codes {
            display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin: 14px 0;
            direction: ltr; font-family: monospace;
        }
        .codes div { background: #f4f5fb; padding: 8px; border-radius: 6px; text-align: center; }
        @media print { .noprint { display: none; } }
    </style>
</head>
<body>
<div class="box">
    @yield('content')
</div>
</body>
</html>
