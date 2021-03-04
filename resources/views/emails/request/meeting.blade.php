<!DOCTYPE html>
<html>
<head>
    <title>Konferensiyalar</title>
</head>
<body>

<h1>4-5 mart kunlari o'tkaziladigan konferensiyada ishtirok eting</h1>
<p>
    Hurmatli {{ $requestModel->username }}&nbsp;({{ $requestModel->authors }}) !<br>
    Sizni 2021 yil 4-5 mart kunlari Muhammad Al-Xorazmiy nomidagi Toshkent axborot texnologiyalari universitetida o'tkaziladigan “Iqtisodiyot tarmoqlarining innovatsion rivojlanishida axborot–kommunikatsiya texnologiyalarining ahamiyati” mavzusiga bag'ishlangan ilmiy-texnik anjumaniga taklif etamiz.<br>
    Konferentsiyaning ochilish marosimi 4 mart kuni soat 1000 da universitet katta majlislar zalida (Zoom orqali) o'tkaziladi.<br>
</p>
<p>
    <h3>Kirish so'zini oflayn va onlayn turda tinglashingiz mumkn</h3><br>
    Oflayn:<br>
    Manzil: TATU, kichik majlislar zali<br>

    Birinchi yalpi majlis vaqti: 10:00 – 12:00<br>

    TATU rektori S.N. Babaxodjaevning kirish so'zi<br>
    Onlayn:<br>
    Majlista Zoom orqali qatnashish uchun quydagi Havolaga uting:
    <a href="https://us02web.zoom.us/j/83914614041?pwd=YkVnNlpxblp5ems2eklvbU43SWNFQT09%20">https://us02web.zoom.us/j/83914614041?pwd=YkVnNlpxblp5ems2eklvbU43SWNFQT09%20</a>


    Konferensiya identifikatori: 83914614041
    Kirish kodi: 764643

</p>
<p>
    <h2>Asosiy konferensiya</h2>
    @if($requestModel->category->id == 7)
        <span style="color: red;">Diqqat: Asosiy konferensiya oflayn turda o'tkazilinadi</span><br>
        Manzil: Toshkent axborot texnologiyalari universiteti, "Axborot xavfsizligi" kafedrasi, "D" blok 2-qavat, 205 xona
    @else
        <span style="color: red;">Diqqat: Asosiy konferensiya onlayn turda zoom orqali o'tkazilinadi</span><br>
    @endif
    Konferensiyani tinglash uchun ushbu havolaga o'ting <a href="{{ $requestModel->category->meeting_link }}">{{ $requestModel->category->meeting_link }}</a><br>
    {!! $requestModel->category->meeting_info !!}
</p>
<p>
    <ul>
        <li>Yo'nalish: #{{ $requestModel->category->name }}</li>
        <li>FIO: {{ $requestModel->username }}</li>
    </ul>
</p>
</body>
</html>
