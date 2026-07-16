<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 – Forbidden | Product Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family:'Inter',sans-serif; background:#f1f5f9; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; }
        .error-card { text-align:center; padding:60px 40px; max-width:500px; }
        .error-code { font-size:7rem; font-weight:800; background:linear-gradient(135deg,#ef4444,#f97316); -webkit-background-clip:text; -webkit-text-fill-color:transparent; line-height:1; }
        .error-title { font-size:1.5rem; font-weight:700; color:#0f172a; margin:16px 0 8px; }
        .error-msg { color:#64748b; font-size:.9rem; margin-bottom:28px; }
    </style>
</head>
<body>
    <div class="error-card">
        <i class="bi bi-shield-x" style="font-size:3rem;color:#ef4444;"></i>
        <div class="error-code">403</div>
        <div class="error-title">Access Forbidden</div>
        <p class="error-msg">You don't have permission to access this resource.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">
            <i class="bi bi-house me-2"></i>Go Home
        </a>
    </div>
</body>
</html>
