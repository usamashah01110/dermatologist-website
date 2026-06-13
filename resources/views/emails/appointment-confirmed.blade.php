<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmed</title>
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
                            <div style="margin-top:14px; font-size:40px;">✅</div>
                            <h1 style="margin:8px 0 0; font-size:22px; color:#ffffff;">Appointment Confirmed</h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:36px 40px;">
                            <p style="margin:0 0 16px; font-size:16px;">Dear <strong>{{ $appointment->patient_name }}</strong>,</p>

                            <p style="margin:0 0 16px; font-size:15px; line-height:1.6; color:#374151;">
                                Good news! Your appointment with <strong>Dr. {{ $doctorName }}</strong> has been
                                <strong style="color:#16a34a;">confirmed</strong>. Here are your appointment details:
                            </p>

                            {{-- Appointment details card --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0fdf4; border:1px solid #bbf7d0; border-radius:12px; margin:8px 0 24px;">
                                <tr>
                                    <td style="padding:20px 22px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding:6px 0; font-size:14px; color:#64748b; width:140px;">Doctor</td>
                                                <td style="padding:6px 0; font-size:15px; font-weight:bold;">Dr. {{ $doctorName }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; font-size:14px; color:#64748b;">Date</td>
                                                <td style="padding:6px 0; font-size:15px; font-weight:bold;">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, d M Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; font-size:14px; color:#64748b;">Time</td>
                                                <td style="padding:6px 0; font-size:15px; font-weight:bold;">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; font-size:14px; color:#64748b;">Type</td>
                                                <td style="padding:6px 0; font-size:15px; font-weight:bold;">{{ ucfirst(str_replace('_', ' ', $appointment->appointment_type)) }}</td>
                                            </tr>
                                            @if($appointment->concern_category)
                                            <tr>
                                                <td style="padding:6px 0; font-size:14px; color:#64748b;">Concern</td>
                                                <td style="padding:6px 0; font-size:15px; font-weight:bold;">{{ ucfirst($appointment->concern_category) }}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 8px; font-size:14px; line-height:1.6; color:#374151;">
                                Please arrive 10 minutes early. If you need to reschedule or cancel, you can manage this appointment
                                from your DermaConnect dashboard.
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#0f172a; padding:24px 40px; text-align:center;">
                            <p style="margin:0 0 6px; font-size:13px; color:#94a3b8;">We look forward to seeing you.</p>
                            <p style="margin:0; font-size:12px; color:#64748b;">© {{ date('Y') }} DermaConnect. All rights reserved.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
