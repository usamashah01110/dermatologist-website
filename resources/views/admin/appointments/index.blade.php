@extends('admin.include.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Appointments
    </h4>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Stat cards --}}
    <div class="row g-4 mb-4">
        @php
            $cards = [
                ['label' => 'Total',     'value' => $stats['total'],     'bg' => 'bg-label-primary'],
                ['label' => 'Pending',   'value' => $stats['pending'],   'bg' => 'bg-label-warning'],
                ['label' => 'Confirmed', 'value' => $stats['confirmed'], 'bg' => 'bg-label-info'],
                ['label' => 'Completed', 'value' => $stats['completed'], 'bg' => 'bg-label-success'],
                ['label' => 'Cancelled', 'value' => $stats['cancelled'], 'bg' => 'bg-label-danger'],
            ];
        @endphp
        @foreach($cards as $card)
            <div class="col-sm-6 col-lg">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="badge {{ $card['bg'] }} rounded-pill mb-2">{{ $card['label'] }}</span>
                        <h3 class="mb-0">{{ $card['value'] }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
            <h5 class="mb-0">
                Appointments
                @if($date)
                    <small class="text-muted">— {{ \Carbon\Carbon::parse($date)->format('D, d M Y') }}</small>
                @else
                    <small class="text-muted">— all dates</small>
                @endif
            </h5>

            {{-- Date filter --}}
            <form method="GET" action="{{ route('appointments.index') }}" class="d-flex align-items-center gap-2">
                <input type="date" name="date" value="{{ $date }}" class="form-control form-control-sm" style="max-width: 180px;">
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                @if($date)
                    <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-secondary">Show all</a>
                @endif
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        @unless($isPatient)<th>Patient</th>@endunless
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Type</th>
                        <th>Concern</th>
                        <th>Images</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($appointments as $appointment)
                        @php
                            $badge = [
                                'pending'   => 'bg-label-warning',
                                'confirmed' => 'bg-label-info',
                                'completed' => 'bg-label-success',
                                'cancelled' => 'bg-label-danger',
                            ][$appointment->status] ?? 'bg-label-secondary';
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @unless($isPatient)
                                <td>
                                    <strong>{{ $appointment->patient_name }}</strong><br>
                                    <small class="text-muted">{{ $appointment->patient_phone }}</small>
                                </td>
                            @endunless
                            <td>{{ optional(optional($appointment->dermatologist)->user)->name ?? '—' }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $appointment->appointment_type)) }}</td>
                            <td>{{ $appointment->concern_category ? ucfirst($appointment->concern_category) : '—' }}</td>
                            <td>
                                @forelse($appointment->images as $image)
                                    <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank" title="View image">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Concern image"
                                             class="rounded me-1 mb-1" style="width: 38px; height: 38px; object-fit: cover;">
                                    </a>
                                @empty
                                    <span class="text-muted">—</span>
                                @endforelse
                            </td>
                            <td><span class="badge {{ $badge }}">{{ ucfirst($appointment->status) }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @if($isPatient)
                                            {{-- Patients may only cancel their own upcoming appointment --}}
                                            @if(in_array($appointment->status, ['pending', 'confirmed']))
                                                <form method="POST" action="{{ route('appointments.updateStatus', $appointment) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="dropdown-item text-danger"
                                                            onclick="return confirm('Cancel this appointment?')">
                                                        <i class="bx bx-x-circle me-1"></i> Cancel
                                                    </button>
                                                </form>
                                            @else
                                                <span class="dropdown-item text-muted">No actions</span>
                                            @endif
                                        @else
                                            @foreach(['confirmed' => 'Confirm', 'completed' => 'Mark completed', 'cancelled' => 'Cancel', 'pending' => 'Set pending'] as $status => $label)
                                                @continue($appointment->status === $status)
                                                <form method="POST" action="{{ route('appointments.updateStatus', $appointment) }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $status }}">
                                                    <button type="submit" class="dropdown-item">{{ $label }}</button>
                                                </form>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">No appointments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
