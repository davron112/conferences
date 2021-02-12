<!DOCTYPE html>
<html>
<head>
    <title>Konferensiyalar</title>
</head>
<body>

<h1>Yangi maqola kelib tushdi</h1>
<p>Ishtirokchi FIO:</p>
<ul>
    <li>FIO: {{ $requestModel->username }}</li>
    <li>Email: {{ $requestModel->email }}</li>
    <li>Mualliflar: {{ $requestModel->authors }}</li>
    <li>Yo'nalish: {{ $requestModel->category->name }}</li>
    <li>Mavzu: {{ $requestModel->subject }}</li>
    <li>To'lov statusi: {{ $requestModel->payment_status }}</li>
    <li>Fayl: <a href="{{ $requestModel->file }}">{{ $requestModel->file }}</a></li>
</ul>
</body>
</html>
