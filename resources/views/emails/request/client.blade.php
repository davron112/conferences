<!DOCTYPE html>
<html>
<head>
    <title>Konferensiyalar</title>
</head>
<body>

<h1>Sizning murojatingiz ko'rib chiqish uchun qabul qilindi</h1>
<p>Sizga javob xabari jo'natilinadi</p>
Sizning maqolangiz:
<ul>
    <li>FIO: {{ $requestModel->username }}</li>
    <li>Email: {{ $requestModel->email }}</li>
    <li>Mualliflar: {{ $requestModel->authors }}</li>
    <li>Yo'nalish: {{ $requestModel->category->name }}</li>
    <li>Mavzu: {{ $requestModel->subject }}</li>
    <li>To'lov statusi: {{ $requestModel->payment_status }}</li>
    <li>Fayl: <a href="https://conferences-list.uz/storage/{{ $requestModel->file }}">https://conferences-list.uz/storage/{{ $requestModel->file }}</a></li>
</ul>
</body>
</html>
