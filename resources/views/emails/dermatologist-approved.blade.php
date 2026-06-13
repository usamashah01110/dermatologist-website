<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Approved</title>
</head>
<body style="margin:0; padding:0; background-color:#f1f5f9; font-family:Arial, 'Segoe UI', sans-serif; color:#1f2937;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f1f5f9; padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 8px 28px rgba(15,23,42,0.08);">

                    {{-- Header --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#0d47a1,#1565c0,#42a5f5); padding:36px 40px; text-align:center;">
                            <div style="font-size:24px; font-weight:bold; color:#ffffff; letter-spacing:.5px;">Derma<span style="color:#bbdefb;">Connect</span></div>
                            <div style="margin-top:14px; font-size:40px;">🎉</div>
                            <h1 style="margin:8px 0 0; font-size:22px; color:#ffffff;">You're Approved!</h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:36px 40px;">
                            <p style="margin:0 0 16px; font-size:16px;">Dear <strong>Dr. {{ $doctorName }}</strong>,</p>

                            <p style="margin:0 0 16px; font-size:15px; line-height:1.6; color:#374151;">
                                Great news — our medical team has reviewed and <strong style="color:#16a34a;">approved</strong> your
                                dermatologist profile on DermaConnect. Your profile is now live and visible to patients across the platform.
                            </p>

                            {{-- Profile summary card --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; margin:8px 0 24px;">
                                <tr>
                                    <td style="padding:18px 20px;">
                                        <p style="margin:0 0 10px; font-size:13px; text-transform:uppercase; letter-spacing:.5px; color:#64748b;">Your Profile</p>
                                        <p style="margin:0 0 6px; font-size:15px;"><strong>Specialization:</strong> {{ $dermatologist->specialization }}</p>
                                        <p style="margin:0 0 6px; font-size:15px;"><strong>Qualification:</strong> {{ $dermatologist->qualification }}</p>
                                        <p style="margin:0 0 6px; font-size:15px;"><strong>Experience:</strong> {{ $dermatologist->experience_year }} years</p>
                                        <p style="margin:0; font-size:15px;"><strong>Clinic:</strong> {{ $dermatologist->clinic_address }}, {{ $dermatologist->city }}</p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 24px; font-size:15px; line-height:1.6; color:#374151;">
                                You can now sign in to manage your availability, view appointment requests, and connect with patients.
                            </p>

                            {{-- CTA --}}
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 8px;">
                                <tr>
                                    <td style="border-radius:50px; background:linear-gradient(135deg,#1565c0,#42a5f5);">
                                        <a href="{{ $loginUrl }}" style="display:inline-block; padding:14px 36px; font-size:15px; font-weight:bold; color:#ffffff; text-decoration:none; border-radius:50px;">
                                            Sign In to Your Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#0f172a; padding:24px 40px; text-align:center;">
                            <p style="margin:0 0 6px; font-size:13px; color:#94a3b8;">Thank you for joining DermaConnect.</p>
                            <p style="margin:0; font-size:12px; color:#64748b;">© {{ date('Y') }} DermaConnect. All rights reserved.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
