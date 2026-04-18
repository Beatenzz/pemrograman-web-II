<html>
<head><title>Variabel Static</title></head>
<body>
    <h1>Variabel Static</h1>
    <?php
    function test() {
        static $a = 0; // variabel tetap ada dalam lingkup fungsi [cite: 790]
        echo "Nilai a: " . $a . "<br>"; // [cite: 791, 792, 793]
        $a++; // Nilai bertambah setiap kali fungsi dipanggil [cite: 794]
    }

    test(); // Nilai a: 0 [cite: 796]
    test(); // Nilai a: 1 [cite: 797]
    test(); // Nilai a: 2 [cite: 798]
    test(); // Nilai a: 3 [cite: 799]
    test(); // Nilai a: 4 [cite: 800]
    ?>
</body>
</html>