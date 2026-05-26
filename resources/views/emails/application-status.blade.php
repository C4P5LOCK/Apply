<h2>Hello {{ $application->full_name }},</h2>

<p>Your application status has been updated. Thanks</p>

<p>
    <strong>Current Status:</strong>
    {{ ucfirst(str_replace('_', ' ', $application->progress)) }}
</p>

<p>Thank you.</p>