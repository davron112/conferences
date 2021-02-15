<!DOCTYPE html>
<html>
<head>
    <title>Konferensiyalar</title>
</head>
<body>

<h1>Sizning seksiyangizga yangi maqola kelib tushdi</h1>
<ul>
    <li>№: #{{ $requestModel->id }}</li>
    <li>FIO: {{ $requestModel->username }}</li>
    <li>Email: {{ $requestModel->email }}</li>
    <li>Foydalanuvchi xabari: {{ $requestModel->note_client }}</li>
    <li>Mualliflar: {{ $requestModel->authors }}</li>
    <li>Yo'nalish: {{ $requestModel->category->name }}</li>
    <li>Mavzu: {{ $requestModel->subject }}</li>
    <li>To'lov statusi: {{ $requestModel->payment_status }}</li>
    <li>Fayl: <a href="https://conferences-list.uz/storage/{{ $requestModel->file }}">https://conferences-list.uz/storage/{{ $requestModel->file }}</a></li>
</ul>
<p style="color: red;">Javob xabari ushbu emailga jo'natilinishi kerak <a href="mailto:{{ $requestModel->email }}">{{ $requestModel->email }}</a> </p>


</body>
</html>
