<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Product Management System – Sign in to manage your products">
    <title>@yield('title', 'Authentication') | Product Management</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent: #6366f1;
            --accent-dark: #4f46e5;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated gradient background blobs */
        body::before, body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .3;
            animation: float 8s ease-in-out infinite;
        }

        body::before {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #6366f1, #8b5cf6);
            top: -150px; left: -150px;
        }

        body::after {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #06b6d4, #3b82f6);
            bottom: -100px; right: -100px;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(30px, 20px) scale(1.05); }
        }

        .auth-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 16px;
        }

        .auth-card {
            background: rgba(255,255,255,.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 20px;
            padding: 40px 36px;
            box-shadow: 0 25px 60px rgba(0,0,0,.4);
            animation: slideUp .5s ease forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-brand-icon {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            border-radius: 16px;
            display: inline-flex;
            align-items: center; justify-content: center;
            font-size: 1.5rem; color: #fff;
            margin-bottom: 12px;
            box-shadow: 0 8px 24px rgba(99,102,241,.4);
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            margin: 0;
        }

        .auth-subtitle {
            font-size: .85rem;
            color: #94a3b8;
            margin-top: 4px;
        }

        .form-label {
            font-size: .8rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 6px;
        }

        .form-control {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 10px;
            color: #fff;
            font-size: .875rem;
            padding: 10px 14px;
            transition: all .2s ease;
        }

        .form-control::placeholder { color: #64748b; }

        .form-control:focus {
            background: rgba(255,255,255,.12);
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(99,102,241,.25);
            color: #fff;
        }

        .input-group-text {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.12);
            border-right: none;
            color: #64748b;
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .invalid-feedback { font-size: .75rem; }

        .is-invalid { border-color: #ef4444 !important; }

        .btn-auth {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: .9rem;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
            transition: all .2s ease;
            box-shadow: 0 4px 16px rgba(99,102,241,.35);
        }

        .btn-auth:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(99,102,241,.45);
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: .85rem;
            color: #64748b;
        }

        .auth-footer a {
            color: #a5b4fc;
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover { color: #c7d2fe; }

        .form-check-label { color: #94a3b8; font-size: .8rem; }
        .form-check-input:checked { background-color: var(--accent); border-color: var(--accent); }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
