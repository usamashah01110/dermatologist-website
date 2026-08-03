<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body style="margin:0; padding:0; background-color:#f1f5f9; font-family:Arial, 'Segoe UI', sans-serif; color:#1f2937;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f1f5f9; padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 8px 28px rgba(15,23,42,0.08);">

                    {{-- Header --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#047857,#10b981,#34d399); padding:36px 40px; text-align:center;">
                            <div style="font-size:24px; font-weight:bold; color:#ffffff; letter-spacing:.5px;">Derma<span style="color:#d1fae5;">Connect</span></div>
                            <div style="margin-top:14px; font-size:40px;">✉️</div>
                            <h1 style="margin:8px 0 0; font-size:22px; color:#ffffff;">New Contact Message</h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:36px 40px;">
                            <p style="margin:0 0 16px; font-size:15px; line-height:1.6; color:#374151;">
                                A visitor sent a message through the website contact form.
                            </p>

                            {{-- Sender details card --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0fdf4; border:1px solid #bbf7d0; border-radius:12px; margin:8px 0 24px;">
                                <tr>
                                    <td style="padding:20px 22px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding:6px 0; font-size:14px; color:#64748b; width:140px;">Name</td>
                                                <td style="padding:6px 0; font-size:15px; font-weight:bold;">{{ $name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; font-size:14px; color:#64748b;">Email</td>
                                                <td style="padding:6px 0; font-size:15px; font-weight:bold;">
                                                    <a href="mailto:{{ $email }}" style="color:#047857; text-decoration:none;">{{ $email }}</a>
                                                </td>
                                            </tr>
                                            @if(!empty($phone))
                                            <tr>
                                                <td style="padding:6px 0; font-size:14px; color:#64748b;">Phone</td>
                                                <td style="padding:6px 0; font-size:15px; font-weight:bold;">{{ $phone }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td style="padding:6px 0; font-size:14px; color:#64748b;">Subject</td>
                                                <td style="padding:6px 0; font-size:15px; font-weight:bold;">{{ $subject }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 8px; font-size:14px; color:#64748b; text-transform:uppercase; letter-spacing:.5px;">Message</p>
                            <div style="font-size:15px; line-height:1.7; color:#1f2937; white-space:pre-line;">{{ $body }}</div>

                            <p style="margin:24px 0 0; font-size:14px; line-height:1.6; color:#374151;">
                                Hit reply to respond directly to {{ $name }}.
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#0f172a; padding:24px 40px; text-align:center;">
                            <p style="margin:0 0 6px; font-size:13px; color:#94a3b8;">Sent from the DermaConnect contact page.</p>
                            <p style="margin:0; font-size:12px; color:#64748b;">© {{ date('Y') }} DermaConnect. All rights reserved.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
