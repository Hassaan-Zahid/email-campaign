<!DOCTYPE html>
<html>
<head>
    <title>{{ $campaign->subject }}</title>
</head>
<body>
{!! $body !!}

@if(isset($customer))
    <p>Sent to: {{ $customer->name }} ({{ $customer->email }})</p>
@endif
</body>
</html>