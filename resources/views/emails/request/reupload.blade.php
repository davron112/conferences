<!DOCTYPE html>
<html>
<head>
    <title>Konferensiyalar</title>
</head>
<body>

<h1>Maqolangizni qayta yuklash haqida:</h1>

<p>
    Assalomu aleykum.<br>
    Sizning #{{ $requestModel->id }} raqamli maqolangizda kamchiliklar mavjud.<br>
    Qayta yuklamasangiz sizning maqolangiz qabul qilinmasligi mumkin.<br>
    <h3>Mutaxassis javobi:</h3> <b>{{ $text }}</b>
</p>
<p>
    <span style="color: #b3710d;">Qayta yuklash uchun quyidagi havolaga bosing:</span><br>
    <a href="http://conferences-list.uz/change?hash={{ $requestModel->hash }}">http://conferences-list.uz/change?hash={{ $requestModel->hash }}</a>
</p>
</body>
</html>
