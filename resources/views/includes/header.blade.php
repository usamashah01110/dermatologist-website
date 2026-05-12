<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DermaConnect – Expert Skin Health</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <link href="{{ asset('style.css') }}" rel="stylesheet"/>
  <link href="{{ asset('dermatogist.css') }}" rel="stylesheet"/>
  <link href="{{ asset('register.css') }}" rel="stylesheet"/>
  <link href="{{ asset('skincare.css') }}" rel="stylesheet"/>
  <link href="{{ asset('servicedetail.css') }}" rel="stylesheet"/>

        <style>
        .toast-container-custom {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 380px;
        }

        .toast-custom {
            background: #fff;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
            border-left: 4px solid #10b981;
            animation: slideIn 0.4s ease-out, fadeOut 0.5s ease-in 4.5s forwards;
        }

        .toast-custom.error {
            border-left-color: #ef4444;
        }

        .toast-icon {
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .toast-icon.success { color: #10b981; }
        .toast-icon.error   { color: #ef4444; }

        .toast-content { flex: 1; }

        .toast-title {
            font-weight: 600;
            margin: 0 0 4px;
            color: #111827;
            font-size: 0.95rem;
        }

        .toast-message {
            margin: 0;
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.4;
        }

        .toast-close {
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 0;
            font-size: 1.1rem;
        }

        @keyframes slideIn {
            from { transform: translateX(120%); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }

        @keyframes fadeOut {
            to { opacity: 0; transform: translateX(120%); }
        }
    </style>
</head>

<body>
