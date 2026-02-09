<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MGA App' }}</title>
    <style>
        :root {
            --bg: #0f172a;
            --panel: #111827;
            --panel-light: #1f2937;
            --primary: #38bdf8;
            --primary-dark: #0ea5e9;
            --text: #e5e7eb;
            --muted: #94a3b8;
            --danger: #f87171;
            --radius: 12px;
            --shadow: 0 20px 60px rgba(0,0,0,0.35);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 20% 20%, rgba(56,189,248,0.12), transparent 25%),
                        radial-gradient(circle at 80% 10%, rgba(99,102,241,0.12), transparent 25%),
                        radial-gradient(circle at 50% 80%, rgba(52,211,153,0.12), transparent 25%),
                        var(--bg);
            color: var(--text);
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        a { color: var(--primary); text-decoration: none; }
        a:hover { color: var(--primary-dark); }
        .card {
            width: min(480px, 92vw);
            background: linear-gradient(145deg, var(--panel), var(--panel-light));
            border: 1px solid rgba(255,255,255,0.04);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 28px;
            backdrop-filter: blur(10px);
        }
        h1, h2, h3 { margin: 0 0 10px; font-weight: 700; letter-spacing: -0.02em; }
        p { margin: 0 0 14px; color: var(--muted); }
        form { display: grid; gap: 16px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; color: #cbd5e1; }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(17,24,39,0.7);
            color: var(--text);
            transition: border-color 150ms ease, box-shadow 150ms ease;
        }
        input:focus {
            outline: none;
            border-color: rgba(56,189,248,0.7);
            box-shadow: 0 0 0 3px rgba(56,189,248,0.15);
        }
        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        button {
            border: none;
            cursor: pointer;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #0b1224;
            transition: transform 120ms ease, box-shadow 120ms ease;
            box-shadow: 0 12px 30px rgba(56,189,248,0.25);
        }
        button:hover { transform: translateY(-1px); }
        button:active { transform: translateY(0); }
        .danger { background: linear-gradient(135deg, #f87171, #ef4444); color: #fff; box-shadow: 0 12px 30px rgba(248,113,113,0.25); }
        .error {
            background: rgba(248,113,113,0.12);
            border: 1px solid rgba(248,113,113,0.35);
            color: #fecdd3;
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 6px;
        }
        .muted { color: var(--muted); font-size: 0.95rem; }
        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="card">
        @hasSection('title')
            <p class="muted">@yield('title')</p>
        @endif
        @yield('content')
    </div>
</body>
</html>
