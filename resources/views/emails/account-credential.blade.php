<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account TEDxITENAS</title>
</head>

<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
        style="background:#f4f7fb;padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                    style="max-width:640px;background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 12px 40px rgba(15,23,42,0.10);">
                    <!-- Header dengan warna merah primary -->
                    <tr>
                        <td>
                            <div style="text-align:center;">
                                <img src="https://tedxitenas.com/assets/images/logo-black.png" alt="Logo TEDxITENAS"
                                    style="width:150px;height:auto;margin-top:24px;">
                            </div>
                        </td>
                    </tr>
                    <!-- Konten utama -->
                    <tr>
                        <td style="padding:36px 40px;">
                            <p style="margin:0 0 18px;font-size:16px;line-height:1.8;">Halo
                                <strong>{{ $user->name }}</strong>,
                            </p>
                            <p style="margin:0 0 24px;font-size:15px;line-height:1.8;color:#4b5563;">Your account has
                                been
                                created / updated. Please login using the details below:</p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:14px;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:18px 20px;border-bottom:1px solid #e5e7eb;">
                                        <div
                                            style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:#6b7280;margin-bottom:6px;">
                                            Email</div>
                                        <div
                                            style="font-size:18px;font-weight:bold;color:#111827;word-break:break-word;">
                                            {{ $user->email }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:18px 20px;">
                                        <div
                                            style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:#6b7280;margin-bottom:6px;">
                                            Password</div>
                                        <div style="font-size:18px;font-weight:bold;color:#111827;">{{ $password }}
                                        </div>
                                <tr>
                                </tr>
                            </table>

                            <p style="margin:0;font-size:14px;line-height:1.8;color:#6b7280;">If you have any questions
                                or need assistance, please contact the administrator.</p>
                        </td>
                    </tr>
                    <!-- Footer dengan warna MERAH (sama seperti header) -->
                    <tr>
                        <td style="padding:24px 40px;color:#00000099;text-align:center;font-size:13px;line-height:1.6;">
                            &copy; {{ date('Y') }} TEDxITENAS. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
