<html>
<head><title>Contoh Penggunaan UDF</title></head>
<body>
    <form method="POST"> [cite: 1011]
        Masukkan Bilangan Pertama : <br>
        <input type="text" name="A" size=10> <br> 
        Masukkan Bilangan Kedua : <br>
        <input type="text" name="B" size=10> <br> 
        <input type="submit" name="hitung" value="hitung"> 
    </form>

    <?php
    if (isset($_POST['hitung'])) {
        // Mengambil data dari form
        $A = $_POST["A"]; 
        $B = $_POST["B"]; 

        // Definisi Fungsi-fungsi Matematika [cite: 1023-1041]
        function jumlah($A, $B) {
            return $A + $B;
        }

        function kurang($A, $B) {
            return $A - $B; 
        }

        function kali($A, $B) {
            return $A * $B; 
        }

        function bagi($A, $B) {
            return $A / $B; 
        }

        // Menampilkan Hasil
        echo "Bilangan Pertama : $A <br>"; 
        echo "Bilangan Kedua : $B <br><br>";

        echo "Hasil Penjumlahan: ";
        printf(" %d + %d = %d", $A, $B, jumlah($A, $B));
        echo "<br>";

        echo "Hasil Pengurangan: ";
        printf(" %d - %d = %d", $A, $B, kurang($A, $B)); 
        echo "<br>";

        echo "Hasil Perkalian: ";
        printf(" %d * %d = %d", $A, $B, kali($A, $B));
        echo "<br>";

        echo "Hasil Pembagian: ";
        printf(" %d / %d = %d", $A, $B, bagi($A, $B)); 
    }
    ?>
</body>
</html>