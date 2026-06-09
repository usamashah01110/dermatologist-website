@extends('admin.include.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Welcome banner --}}
    <div class="card bg-primary text-white mb-4">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h5 class="text-white mb-1">Welcome back, {{ $user->name }} 👋</h5>
                <p class="mb-0 text-white-50">You are signed in as <strong>{{ ucfirst($role) }}</strong>.</p>
            </div>
            <a href="{{ route('appointments.index') }}" class="btn btn-light btn-sm">View Appointments</a>
        </div>
    </div>

    @php
        $tiles = [];
        if ($role === 'superadmin') {
            $tiles = [
                ['Doctors', $stats['doctors'] ?? 0, 'bx-user-voice', 'primary'],
                ['Pending Doctors', $stats['pending_doctors'] ?? 0, 'bx-time', 'warning'],
                ['Patients', $stats['patients'] ?? 0, 'bx-group', 'info'],
                ['Appointments', $stats['appointments'] ?? 0, 'bx-calendar', 'success'],
                ["Today's Appointments", $stats['today'] ?? 0, 'bx-calendar-check', 'secondary'],
                ['Pending Appointments', $stats['pending'] ?? 0, 'bx-hourglass', 'danger'],
            ];
        } elseif ($role === 'dermatologist') {
            $tiles = [
                ["Today's Appointments", $stats['today'] ?? 0, 'bx-calendar-check', 'primary'],
                ['Slots Left Today', $stats['remaining'] ?? 0, 'bx-time-five', 'success'],
                ['Upcoming', $stats['upcoming'] ?? 0, 'bx-calendar', 'info'],
                ['Pending', $stats['pending'] ?? 0, 'bx-hourglass', 'warning'],
                ['Total Appointments', $stats['total'] ?? 0, 'bx-list-ul', 'secondary'],
                ['My Patients', $stats['patients'] ?? 0, 'bx-group', 'danger'],
            ];
        } else {
            $tiles = [
                ['My Appointments', $stats['total'] ?? 0, 'bx-calendar', 'primary'],
                ['Upcoming', $stats['upcoming'] ?? 0, 'bx-calendar-check', 'info'],
                ['Pending', $stats['pending'] ?? 0, 'bx-hourglass', 'warning'],
                ['Completed', $stats['completed'] ?? 0, 'bx-check-circle', 'success'],
            ];
        }
    @endphp

    @if($role === 'dermatologist' && ($stats['status'] ?? '') !== 'approved')
        <div class="alert alert-warning">
            <i class="bx bx-info-circle me-1"></i>
            Your dermatologist profile is currently <strong>{{ ucfirst($stats['status'] ?? 'pending') }}</strong>.
            You will appear in the public directory once an admin approves it.
        </div>
    @endif

    <div class="row g-4">
        @foreach($tiles as $tile)
            <div class="col-sm-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-{{ $tile[3] }}">
                                <i class="bx {{ $tile[2] }}"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted d-block">{{ $tile[0] }}</small>
                            <h4 class="mb-0">{{ $tile[1] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
