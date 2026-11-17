<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - {{ __('errors.forbidden-title') }}</title>
    <style>
        * { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 60px;
            flex-wrap: wrap;
            padding: 24px;
            overflow: hidden;
            background: radial-gradient(circle at 30% 20%, #232a55 0%, #11152e 55%, #0a0c1c 100%);
            font-family: Tahoma, Arial, sans-serif;
            color: #e8ebff;
        }
        .server { width: min(300px, 60vw); height: auto; filter: drop-shadow(0 20px 40px rgba(0, 0, 0, .5)); }
        .info { max-width: 420px; text-align: start; }
        .code {
            font-size: clamp(80px, 16vw, 150px);
            font-weight: 800;
            line-height: 1;
            color: #ff4d4f;
            text-shadow: 0 0 30px rgba(255, 77, 79, .45);
            animation: flicker 3s infinite;
        }
        h1 { font-size: 24px; margin: 14px 0 10px; }
        p { margin: 0 0 28px; color: #9aa2d1; line-height: 1.8; }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 8px;
            background: #6259ca;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            box-shadow: 0 8px 24px rgba(98, 89, 202, .45);
            transition: transform .15s;
        }
        .btn:hover { transform: translateY(-2px); }

        .blink { animation: blink 1s infinite; }
        .smoke path { animation: rise 3s infinite ease-out; }
        .smoke path:nth-child(2) { animation-delay: 1s; }
        .smoke path:nth-child(3) { animation-delay: 2s; }
        .spark { animation: spark 1.6s infinite; }

        @keyframes blink { 50% { opacity: .15; } }
        @keyframes rise {
            0% { transform: translateY(10px); opacity: 0; }
            50% { opacity: .7; }
            100% { transform: translateY(-10px); opacity: 0; }
        }
        @keyframes spark { 0%, 60%, 100% { opacity: 0; } 70%, 90% { opacity: 1; } }
        @keyframes flicker { 0%, 92%, 100% { opacity: 1; } 94% { opacity: .55; } 96% { opacity: 1; } 98% { opacity: .7; } }

        @media (max-width: 760px) {
            body { gap: 20px; text-align: center; }
            .info { text-align: center; }
        }
    </style>
</head>
<body>

<svg class="server" viewBox="0 0 300 380" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Server error">
    <!-- دخان -->
    <g class="smoke" fill="none" stroke="#8b93b8" stroke-width="3" stroke-linecap="round" opacity=".6">
        <path d="M110 40c-10-12 10-20 0-34"/>
        <path d="M150 40c-10-12 10-20 0-34"/>
        <path d="M190 40c-10-12 10-20 0-34"/>
    </g>

    <!-- هيكل السيرفر -->
    <rect x="30" y="50" width="240" height="300" rx="14" fill="#1d2142" stroke="#343b6b" stroke-width="3"/>

    <!-- وحدة 1: سليمة -->
    <rect x="46" y="68" width="208" height="76" rx="8" fill="#262b52" stroke="#3b4380"/>
    <circle cx="68" cy="106" r="7" fill="#35d07f"/>
    <rect x="90" y="92" width="140" height="8" rx="4" fill="#343b6b"/>
    <rect x="90" y="108" width="140" height="8" rx="4" fill="#343b6b"/>
    <rect x="90" y="124" width="90" height="8" rx="4" fill="#343b6b"/>

    <!-- وحدة 2: بها عطل -->
    <rect x="46" y="156" width="208" height="76" rx="8" fill="#2a2147" stroke="#e5484d" stroke-width="2"/>
    <circle class="blink" cx="68" cy="194" r="7" fill="#ff4d4f"/>
    <rect x="90" y="180" width="85" height="8" rx="4" fill="#4a3a6e"/>
    <rect x="90" y="196" width="85" height="8" rx="4" fill="#4a3a6e"/>
    <rect x="90" y="212" width="60" height="8" rx="4" fill="#4a3a6e"/>
    <path d="M214 170 L238 212 L190 212 Z" fill="#ffb020"/>
    <rect x="212" y="184" width="4" height="14" rx="2" fill="#2a2147"/>
    <circle cx="214" cy="205" r="2.5" fill="#2a2147"/>

    <!-- شرارات -->
    <path class="spark" d="M30 190 l-16 9 11 5 -13 14" fill="none" stroke="#ffd166" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    <path class="spark" d="M270 200 l16 8 -11 5 13 13" fill="none" stroke="#ffd166" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="animation-delay:.8s"/>

    <!-- وحدة 3: متوقفة -->
    <rect x="46" y="244" width="208" height="76" rx="8" fill="#1f2347" stroke="#2f3566"/>
    <circle cx="68" cy="282" r="7" fill="#4a5078"/>
    <rect x="90" y="268" width="140" height="8" rx="4" fill="#2b3057"/>
    <rect x="90" y="284" width="140" height="8" rx="4" fill="#2b3057"/>
    <rect x="90" y="300" width="90" height="8" rx="4" fill="#2b3057"/>

    <!-- أرجل -->
    <rect x="56" y="350" width="34" height="12" rx="3" fill="#343b6b"/>
    <rect x="210" y="350" width="34" height="12" rx="3" fill="#343b6b"/>
</svg>

<div class="info">
    <div class="code">403</div>
    <h1>{{ __('errors.forbidden-title') }}</h1>
    <p>{{ __('errors.forbidden-text') }}</p>
    <a class="btn" href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/') }}">{{ __('general.dash') }}</a>
</div>

</body>
</html>
