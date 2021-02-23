<!DOCTYPE html>
<html>
<head>
    <title>Konferensiyalar</title>
</head>
<body>

<h1>Anjumanda qatnashish uchun to'lov:</h1>

<p>
    Assalomu aleykum. Tabriklaymiz sizning #{{ $requestModel->id }} raqamli maqolangiz qabul qilindi! <br>
    Anjumanda qatnashish uchun 50 ming so'm hajmdagi summani to'lashingizni so'raymiz.<br>
    <br>
    Maqola mavzusi: {{ $requestModel->username }}<br>
    Maqola mavzusi: {{ $requestModel->subject }}<br>
    Maqola avtorlari: {{ $requestModel->authors }}<br>
    Seksiyasi: {{ $requestModel->category->name }}<br>
</p>
    To'lovni <a target="_blank" href="{{ $link }}">ushbu havola</a> orqali amalga oshirishingiz mumkin<br>
    <a target="_blank" href="{{ $link }}">{{ $link }}</a>
</body>
</html>
