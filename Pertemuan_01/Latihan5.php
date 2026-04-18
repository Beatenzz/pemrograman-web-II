<html>
<head>
    <title>Test Penyisipan PHP Pada HTML</title>
</head>
<body>
    Kapal Asing, Silakan identifikasikan diri Anda! <br>
    <?php
    // Inisiasi variabel [cite: 829]
    $namad = "Jean"; [cite: 830]
    $namat = "Luc"; [cite: 831]
    $namab = "Piccard"; [cite: 832]
    $nilai1 = 25; [cite: 833]
    $nilai2 = 50; [cite: 834]
    $hasil = $nilai1 * $nilai2; [cite: 835]
    $a = 2; [cite: 836]
    $b = 3; [cite: 837]
    $hsl = pow($a, $b); // Fungsi pangkat [cite: 838]
    ?>

    <b>Ini adalah kapal Federasi Planet USS Enterprise.<br>
    <?php
    echo "Saya $namab, $namad $namat $namab, kapten kapal.</b><br>"; // [cite: 842]
    echo "$nilai1 x $nilai2 = $hasil<br>"; // [cite: 843]
    echo "$a ^ $b = $hsl"; // [cite: 844]
    ?>
</body>
</html>