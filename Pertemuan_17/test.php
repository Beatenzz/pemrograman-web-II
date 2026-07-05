<?php
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'benar';

if ($mode == "salah") {
    // Skenario SALAH: Sengaja cetak teks dulu, membuat perintah header di bawahnya gagal/error
    echo "Teks Pengganggu"; 
    
    // Karena gagal meredirect akibat terganjal teks di atas, 
    // kita paksa lompat menggunakan script alternatif agar note-nya muncul di halaman utama
    echo "<script>window.location.href='praktek_error.php?redirect=gagal';</script>";
    exit;
} else {
    // Skenario BENAR: Langsung jalankan header tanpa output apa pun. Lancar jaya!
    header("Location: praktek_error.php?redirect=sukses");
    exit;
}
?>