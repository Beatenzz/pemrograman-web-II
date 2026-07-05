<?php
include 'koneksi.php';

// ==========================================
// 1. LOGIKA HAPUS DATA PENDAFTAR
// ==========================================
if(isset($_GET['hapus'])) {
    $no_daftar_hapus = $_GET['hapus'];
    
    // Hapus dari tabel pendaftaran
    $delete_pendaftar = mysqli_query($conn, "DELETE FROM pendaftaran WHERE no_daftar = '$no_daftar_hapus'");
    
    // Hapus juga dari tabel pengurusan agar tidak ada data yang menggantung (orphan data)
    $delete_pengurusan = mysqli_query($conn, "DELETE FROM pengurusan WHERE no_daftar = '$no_daftar_hapus'");
    
    if($delete_pendaftar) {
        echo "<script>alert('Data pendaftar berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.');</script>";
    }
}

// ==========================================
// 2. LOGIKA SIMPAN DATA PENDAFTARAN
// ==========================================
if (isset($_POST['simpan_daftar'])) {
    $no_daftar = $_POST['no_daftar'];
    $nama_pemohon = $_POST['nama_pemohon'];
    $tgl_daftar = $_POST['tgl_daftar'];
    
    // Cek apakah No Daftar sudah ada (mencegah duplikat)
    $cek_exist = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE no_daftar = '$no_daftar'");
    if(mysqli_num_rows($cek_exist) > 0) {
        echo "<script>alert('No Daftar sudah digunakan! Silakan gunakan nomor lain.');</script>";
    } else {
        // Logika Cek Kapasitas 5 orang per hari
        $jadwal_fix = $tgl_daftar;
        $kapasitas_penuh = true;
        
        while($kapasitas_penuh) {
            $query_cek = mysqli_query($conn, "SELECT COUNT(*) as total FROM pendaftaran WHERE DATE(jadwal_datang) = '$jadwal_fix'");
            $data_cek = mysqli_fetch_assoc($query_cek);
            
            if($data_cek['total'] < 5) {
                $kapasitas_penuh = false; // Ada slot kosong
            } else {
                // Jika penuh 5 orang, geser jadwal ke 1 hari berikutnya
                $jadwal_fix = date('Y-m-d', strtotime($jadwal_fix . ' +1 day'));
            }
        }
        
        // Set jam datang default menjadi jam 08:00
        $jadwal_datang = $jadwal_fix . " 08:00:00";
        
        $insert = mysqli_query($conn, "INSERT INTO pendaftaran (no_daftar, nama_pemohon, tgl_daftar, jadwal_datang) VALUES ('$no_daftar', '$nama_pemohon', '$tgl_daftar', '$jadwal_datang')");
        
        if($insert) {
            echo "<script>alert('Data pendaftaran berhasil disimpan!'); window.location='index.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Paspor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        
        <div class="mb-4 border-bottom pb-2">
            <h2 class="fw-bold text-dark mb-0">PENGAJUAN PASPOR</h2>
            <h4 class="text-secondary mb-1">Kantor Imigrasi Cabang</h4>
            <p class="text-muted fw-bold mb-0">Programmer : Dwi Ihwanto</p>
        </div>

        <div class="mb-4">
            <a href="index.php" class="btn btn-primary btn-sm me-1 fw-semibold">Daftar</a>
            <a href="daftar_ulang.php" class="btn btn-outline-secondary btn-sm me-1 fw-semibold">Daftar Ulang</a>
            <a href="pengurusan.php" class="btn btn-outline-secondary btn-sm fw-semibold">Pengurusan</a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0 fw-semibold">Input Pendaftaran</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label fw-semibold">No. Daftar</label>
                        <div class="col-sm-4">
                            <input type="text" name="no_daftar" class="form-control" placeholder="Masukkan No Daftar" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label fw-semibold">Nama Pemohon</label>
                        <div class="col-sm-6">
                            <input type="text" name="nama_pemohon" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label fw-semibold">Tanggal Daftar</label>
                        <div class="col-sm-4">
                            <input type="date" name="tgl_daftar" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" name="simpan_daftar" class="btn btn-primary px-4 fw-semibold">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr class="my-4">

        <div class="card shadow-sm mb-5">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title mb-0 fw-semibold">Data Pendaftar</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 10%;" class="text-center">No. Daftar</th>
                                <th>Nama Pemohon</th>
                                <th style="width: 15%;">Tgl Daftar</th>
                                <th>Hari, Tanggal Datang</th>
                                <th style="width: 10%;">Jam</th>
                                <th style="width: 12%;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM pendaftaran ORDER BY jadwal_datang ASC");
                            if(mysqli_num_rows($query) == 0) {
                                echo "<tr><td colspan='6' class='text-center text-muted py-3'>Belum ada data pendaftar</td></tr>";
                            } else {
                                while($row = mysqli_fetch_assoc($query)) {
                                    $waktu_datang = strtotime($row['jadwal_datang']);
                                    echo "<tr>
                                            <td class='text-center'><span class='badge bg-secondary d-block py-2'>{$row['no_daftar']}</span></td>
                                            <td class='fw-semibold'>{$row['nama_pemohon']}</td>
                                            <td>{$row['tgl_daftar']}</td>
                                            <td>".date('l, d M Y', $waktu_datang)."</td>
                                            <td>".date('H:i', $waktu_datang)."</td>
                                            <td class='text-center'>
                                                <a href='daftar_ulang.php?no_daftar={$row['no_daftar']}' class='btn btn-sm btn-success text-white fw-semibold d-block mb-1'>
                                                    Daftar Ulang
                                                </a>
                                                <a href='index.php?hapus={$row['no_daftar']}' class='btn btn-sm btn-danger text-white fw-semibold d-block' onclick=\"return confirm('Yakin ingin menghapus pendaftar dengan No: {$row['no_daftar']}?');\">
                                                    Hapus
                                                </a>
                                            </td>
                                          </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>