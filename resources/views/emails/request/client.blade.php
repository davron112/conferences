<!DOCTYPE html>
<html>
<head>
    <title>Konferensiyalar</title>
</head>
<body>

<h1>Sizning so'rovingiz ko'rib chiqish jarayonida</h1>
<p>Sizga javob xabari {{ $requestModel->category->owner_email }} orqali jo'natilinadi</p>
Sizning maqolangiz:
<ul>
    <li>Maqola raqami: #{{ $requestModel->id }}</li>
    <li>FIO: {{ $requestModel->username }}</li>
    <li>Email: {{ $requestModel->email }}</li>
    <li>Telefon: {{ $requestModel->phone }}</li>
    <li>Mualliflar: {{ $requestModel->authors }}</li>
    <li>Yo'nalish: {{ $requestModel->category->name }}</li>
    <li>Mavzu: {{ $requestModel->subject }}</li>
    <li>To'lov statusi: {{ $requestModel->payment_status }}</li>
    <li>Fayl: <a href="https://conferences-list.uz/storage/{{ $requestModel->file }}">https://conferences-list.uz/storage/{{ $requestModel->file }}</a></li>
</ul>
<p>
<span style="color: red;">Xolati: <b>Ko'rib chiqish jarayonida</b></span>
    <br/>
<span style="color: red;">Murojaat uchun email: <a href="mailto:{{ $requestModel->category->owner_email }}">{{ $requestModel->category->owner_email }}</a></span>
</p>
</body>
</html>
