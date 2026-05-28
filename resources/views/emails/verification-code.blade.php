<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 40px 0; }
        .container { max-width: 420px; margin: 0 auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #87B4B8, #3ab3c3); padding: 32px 24px; text-align: center; }
        .header h1 { color: #fff; font-size: 22px; margin: 0; }
        .body { padding: 32px 24px; }
        .body p { color: #5f6b84; font-size: 14px; line-height: 1.6; margin: 0 0 16px; }
        .code-box { background: #f8f9fa; border: 2px dashed #87B4B8; border-radius: 12px; padding: 20px; text-align: center; margin: 24px 0; }
        .code { font-size: 32px; font-weight: 700; letter-spacing: 8px; color: #3d4a5e; }
        .footer { padding: 20px 24px; text-align: center; border-top: 1px solid #eee; }
        .footer p { color: #aaa; font-size: 11px; margin: 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FilkomCare</h1>
        </div>
        <div class="body">
            <p>Halo <strong>{{ $userName }}</strong>,</p>
            <p>Berikut adalah kode verifikasi untuk menyelesaikan pendaftaran akun FilkomCare kamu:</p>
            <div class="code-box">
                <div class="code">{{ $code }}</div>
            </div>
            <p>Kode ini berlaku selama <strong>10 menit</strong>. Jangan bagikan kode ini kepada siapapun.</p>
            <p>Jika kamu tidak merasa mendaftar di FilkomCare, abaikan email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} FilkomCare â€” ULTKSP FILKOM UB</p>
        </div>
    </div>
</body>
</html>
