<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
</head>
<body>

<h1>Session Test</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('test'))
    <p>Session value: {{ session('test') }}</p>
@endif

<form method="POST" action="/test">
    @csrf
    <button type="submit">Test POST</button>
</form>

</body>
</html>