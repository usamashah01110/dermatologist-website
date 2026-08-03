@extends('admin.include.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Appointment</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('appointments.update', $appointment) }}">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Patient</label>
                    <input class="form-control" value="{{ $appointment->patient_name }} ({{ $appointment->patient_email }})" readonly>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="appointment_date" class="form-control" value="{{ old('appointment_date', $appointment->appointment_date->toDateString()) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Time</label>
                        <input type="time" name="appointment_time" class="form-control" value="{{ old('appointment_time', \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i')) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Type</label>
                        <select name="appointment_type" class="form-select">
                            @foreach(['consultation','follow_up','treatment','emergency'] as $type)
                                <option value="{{ $type }}" {{ $appointment->appointment_type === $type ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ', $type)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="4">{{ old('notes', $appointment->notes) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        @foreach(['pending','confirmed','completed','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $appointment->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
