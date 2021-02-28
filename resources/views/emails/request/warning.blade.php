<!DOCTYPE html>
<html>
<head>
    <title>Konferensiyalar</title>
</head>
<body>

<h1>Anjumanda qatnashish uchun to'lovlarni qabul qilish jarayoni yakunlanmoqda:</h1>

<p>
    Assalomu aleykum. Sizning #{{ $requestModel->id }} raqamli maqolangiz tekshiruvdan o'tdi! <br>
    Anjumanda qatnashish uchun 50 ming so'm hajmdagi summani to'lashingizni so'raymiz.<br>
    <span style="color: #d58512">To'lovni 2 kun davomida amalga oshirmasangiz maqolangiz qabul qilinmasligi mumkin!</span><br>
    <br>
    Jo'natuvchi: {{ $requestModel->username }}<br>
    Maqola mavzusi: {{ $requestModel->subject }}<br>
    Maqola avtorlari: {{ $requestModel->authors }}<br>
    Maqola fayli: <a href="https://conferences-list.uz/storage/{{ $requestModel->file }}">https://conferences-list.uz/storage/{{ $requestModel->file }}</a><br>
    Seksiyasi: {{ $requestModel->category->name }}<br>
</p>
    To'lovni <a target="_blank" href="{{ $link }}">ushbu havola</a> orqali amalga oshirishingiz mumkin<br>
    <a target="_blank" href="{{ $link }}">{{ $link }}</a>
</body>
</html>
