<HTML>
<HEAD>
    <TITLE> Getdate </TITLE>
</HEAD>
<BODY>
    <center>
        <h1>
        <?php
            $sekarang = getdate(); 
            $bulan = $sekarang['month']; // Nama bulan tekstual 
            $hari = $sekarang['mday'];   // Hari dalam bulan 
            $tahun = $sekarang['year'];  // Tahun numeris
            $jam = $sekarang['hours'];   // Jam format 24 jam

            if ($jam <= 11) {
                echo "Selamat Pagi";
            } elseif ($jam > 11 and $jam <= 15) {
                echo "Selamat Siang";
            } elseif ($jam > 15 and $jam <= 18) {
                echo "Selamat Sore";
            } elseif ($jam > 18) {
                echo "Selamat Malam";
            }
        ?>
        </h1>
        <h2>Selamat datang</h2>
        <h3>Sekarang adalah tanggal <?php echo "$hari $bulan $tahun"; ?></h3>
    </center>
</BODY>
</HTML>