<?php
// Mengambil status dari Simulasi 1 (Header)
$note_header = "";
if (isset($_GET['redirect'])) {
    if ($_GET['redirect'] == 'sukses') {
        $note_header = "<div class='alert sukses'><strong>Note Sukses (Normal):</strong> Pengalihan halaman berhasil 100%! Tidak ada error karena fungsi <code>header()</code> langsung dijalankan tanpa terganjal output teks/HTML sebelumnya.</div>";
    } elseif ($_GET['redirect'] == 'gagal') {
        $note_header = "<div class='alert error'><strong>Note Gagal (Error Terjadi):</strong> Di latar belakang, PHP memunculkan pesan <code>Warning: Cannot modify header information - headers already sent by...</code> karena ada perintah <code>echo</code> atau HTML yang keluar duluan sebelum perintah <code>header()</code>.</div>";
    }
}

// ==========================================
// SIMULASI 2: KONEKSI DATABASE
// ==========================================
$pesan_koneksi = "";
if (isset($_GET['action_koneksi'])) {
    $mode = $_GET['action_koneksi'];
    
    if ($mode == "salah") {
        $koneksi = @mysqli_connect("localhost", "user_ngawur", "pass_salah");
        if (!$koneksi) {
            $pesan_koneksi = "<div class='alert error'><strong>Pesan Error (Materi PPT):</strong><br>Warning: mysqli_connect(): Access denied for user 'root'@'localhost' (using password: YES)</div>";
        }
    } else {
        $koneksi = @mysqli_connect("localhost", "root", ""); 
        if ($koneksi) {
            $pesan_koneksi = "<div class='alert sukses'><strong>Sukses:</strong> Koneksi database berhasil terhubung dengan aman!</div>";
        } else {
            $pesan_koneksi = "<div class='alert error'><strong>Info:</strong> Silakan nyalakan (Start) Module MySQL pada panel XAMPP Anda terlebih dahulu untuk melihat kondisi sukses ini.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Praktikum Error Handling 2</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f9; padding: 20px; color: #333; }
        .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { border-bottom: 2px solid #eee; padding-bottom: 10px; color: #2c3e50; }
        .box { background: #fafafa; border-left: 4px solid #3498db; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .btn { display: inline-block; padding: 10px 15px; margin: 5px; color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px; }
        .btn-danger { background: #e74c3c; }
        .btn-success { background: #2ecc71; }
        .alert { padding: 15px; margin-top: 15px; border-radius: 4px; font-family: sans-serif; line-height: 1.5; }
        .error { background: #fde8e7; color: #c0392b; border-left: 4px solid #e74c3c; }
        .sukses { background: #e8f8f5; color: #27ae60; border-left: 4px solid #2ecc71; }
        code { background: rgba(0,0,0,0.05); padding: 2px 6px; border-radius: 4px; font-family: monospace; color: #d63031; }
    </style>
</head>
<body>

<div class="container">
    <h1>Panel Praktik Error Handling 2</h1>
    <p>Gunakan tombol di bawah untuk melihat perbedaan kondisi Error dan Sukses secara instan.</p>

    <div class="box">
        <h2>1. Simulasi Warning: Cannot modify header information</h2>
        <p>Aturan: Sebelum perintah <code>header("Location: ...")</code> tidak boleh ada string/HTML yang dikirim ke browser.</p>
        
        <a href="test.php?mode=salah" class="btn btn-danger">Klik Tombol Merah (Pemicu Error)</a>
        <a href="test.php?mode=benar" class="btn btn-success">Klik Tombol Hijau (Jalankan Normal)</a>
        
        <?php echo $note_header; ?>
    </div>

    <div class="box">
        <h2>2. Simulasi Warning: Access Denied for User</h2>
        <p>Aturan: Terjadi jika username atau password database salah.</p>
        
        <a href="praktek_error.php?action_koneksi=salah" class="btn btn-danger">Tes Koneksi (Gagal)</a>
        <a href="praktek_error.php?action_koneksi=benar" class="btn btn-success">Tes Koneksi (Berhasil)</a>
        
        <?php echo $pesan_koneksi; ?>
    </div>
</div>

</body>
</html>