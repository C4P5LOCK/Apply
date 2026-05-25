<!DOCTYPE html>
<html>
<head>

    <title>Application PDF</title>

    <style>

        body {
            font-family: sans-serif;
            padding: 40px;
        }

        h1 {
            margin-bottom: 30px;
        }

        p {
            margin-bottom: 12px;
        }

        img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

    <h1>Application Details</h1>

    @if($application->passport)

        <img src="{{ public_path('storage/' . $application->passport) }}">

    @endif

    <p>
        <strong>Application Number:</strong>
        {{ $application->application_number }}
    </p>

    <p>
        <strong>Full Name:</strong>
        {{ $application->full_name }}
    </p>

    <p>
        <strong>Phone:</strong>
        {{ $application->phone }}
    </p>

    <p>
        <strong>School:</strong>
        {{ $application->school }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ ucfirst(str_replace('_', ' ', $application->status)) }}
    </p>

</body>
</html>