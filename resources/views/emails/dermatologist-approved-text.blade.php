{{-- Plain-text alternative part. Values are printed raw ({!! !!}) on purpose:
     HTML escaping belongs in the HTML view, and would leak "&amp;" into a
     text/plain body where it cannot be decoded. --}}
Dear Dr. {!! $doctorName !!},

Great news — our medical team has reviewed and APPROVED your dermatologist
profile on DermaConnect. Your profile is now live and visible to patients
across the platform.

YOUR PROFILE
Specialization: {!! $dermatologist->specialization !!}
Qualification: {!! $dermatologist->qualification !!}
Experience: {!! $dermatologist->experience_year !!} years
Clinic: {!! $dermatologist->clinic_address !!}, {!! $dermatologist->city !!}

You can now sign in to manage your availability, view appointment requests,
and connect with patients:

{!! $loginUrl !!}

Thank you for joining DermaConnect.

© {{ date('Y') }} DermaConnect. All rights reserved.
