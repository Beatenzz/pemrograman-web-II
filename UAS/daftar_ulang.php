<?php
include 'koneksi.php';

// Inisialisasi variabel untuk menampung data otomatis
$no_daftar_pilih = isset($_GET['no_daftar']) ? $_GET['no_daftar'] : '';
$nama_pemohon = '';
$hari_harus = '';
$tgl_harus = '';

// Jika ada no_daftar dari URL, cari datanya di tabel pendaftaran
if($no_daftar_pilih != '') {
    $q_cari = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE no_daftar = '$no_daftar_pilih'");
    if($data = mysqli_fetch_assoc($q_cari)) {
        $nama_pemohon = $data['nama_pemohon'];
        $waktu = strtotime($data['jadwal_datang']);
        $hari_harus = date('l', $waktu);      // Mendapatkan nama hari (cth: Monday)
        $tgl_harus = date('Y-m-d', $waktu);   // Mendapatkan tanggal
    }
}

// Logika Hapus Data
if(isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM pengurusan WHERE id = '$id_hapus'");
    echo "<script>alert('Data berhasil dihapus!'); window.location='daftar_ulang.php';</script>";
}

// Logika Simpan Data Daftar Ulang
if(isset($_POST['simpan_berkas'])) {
    $no_daftar = $_POST['no_daftar'];
    $keperluan = $_POST['keperluan'];
    
    // Mengecek apakah checkbox dicentang (jika dicentang = Ada, jika tidak = Tidak)
    $ktp = isset($_POST['ktp']) ? 'Ada' : 'Tidak';
    $kk = isset($_POST['kk']) ? 'Ada' : 'Tidak';
    $ijazah = isset($_POST['ijazah']) ? 'Ada' : 'Tidak';
    
    // Cek apakah no_daftar sudah ada di tabel pengurusan agar tidak dobel
    $cek_exist = mysqli_query($conn, "SELECT * FROM pengurusan WHERE no_daftar = '$no_daftar'");
    
    if(mysqli_num_rows($cek_exist) > 0) {
        echo "<script>alert('Nomor daftar ini sudah melakukan daftar ulang!');</script>";
    } else {
        // Logika Status Keterangan
        if($ktp == 'Ada' && $kk == 'Ada' && $ijazah == 'Ada') {
            $berkas = "lengkap";
            $keterangan = "OK";
            $status = "diterima";
            $pembayaran = 355000;
            
            // Generate No Antrian
            $q_antrian = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengurusan WHERE keterangan = 'OK'");
            $data_antrian = mysqli_fetch_assoc($q_antrian);
            $no_antrian = "A-" . str_pad($data_antrian['total'] + 1, 3, "0", STR_PAD_LEFT);
        } else {
            $berkas = "tidak lengkap";
            $keterangan = "tidak";
            $status = "ditunda";
            $pembayaran = 0;
            $no_antrian = "-";
        }
        
        $insert = mysqli_query($conn, "INSERT INTO pengurusan (no_antrian, no_daftar, keperluan, ktp, kk, ijazah, berkas, status, keterangan, pembayaran) 
                                       VALUES ('$no_antrian', '$no_daftar', '$keperluan', '$ktp', '$kk', '$ijazah', '$berkas', '$status', '$keterangan', '$pembayaran')");
        
        if($insert) {
            echo "<script>alert('Data daftar ulang berhasil disimpan!'); window.location='daftar_ulang.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ulang - Pengajuan Paspor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        
        <!-- Header -->
        <div class="mb-4 border-bottom pb-2">
            <h2 class="fw-bold text-dark mb-0">PENGAJUAN PASPOR</h2>
            <h4 class="text-secondary mb-1">Kantor Imigrasi Cabang</h4>
            <p class="text-muted fw-bold mb-0">Programmer : Dwi Ihwanto</p>
        </div>

        <!-- Menu Navigasi -->
        <div class="mb-4">
            <a href="index.php" class="btn btn-outline-primary btn-sm me-1 fw-semibold">Daftar</a>
            <a href="daftar_ulang.php" class="btn btn-primary btn-sm me-1 fw-semibold text-white">Daftar Ulang</a>
            <a href="pengurusan.php" class="btn btn-outline-primary btn-sm fw-semibold">Pengurusan</a>
        </div>

        <!-- Form Input Daftar Ulang -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0 fw-semibold">Input Daftar Ulang</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label fw-semibold">No. Daftar</label>
                        <div class="col-sm-3">
                            <input type="text" name="no_daftar" class="form-control form-control-sm" value="<?= $no_daftar_pilih ?>" required readonly>
                            <small class="text-muted">*Pilih dari menu Daftar</small>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label fw-semibold">Nama Pemohon</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" value="<?= $nama_pemohon ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label fw-semibold">Hari Harus Datang</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" value="<?= $hari_harus ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label fw-semibold">Tgl Harus Datang</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" value="<?= $tgl_harus ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label fw-semibold">Hari Datang</label>
                        <div class="col-sm-3">
                            <input type="text" name="hari_datang" class="form-control form-control-sm" placeholder="Contoh: Senin" required>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label fw-semibold">Tgl Datang</label>
                        <div class="col-sm-3">
                            <input type="date" name="tgl_datang" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    
                    <!-- Checkbox Berkas -->
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label fw-semibold">Berkas</label>
                        <div class="col-sm-6 pt-1">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="ktp" value="Ada" id="chkKTP">
                                <label class="form-check-label" for="chkKTP">KTP</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="kk" value="Ada" id="chkKK">
                                <label class="form-check-label" for="chkKK">KK</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="ijazah" value="Ada" id="chkIjazah">
                                <label class="form-check-label" for="chkIjazah">Ijazah/Akte</label>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Keperluan -->
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label fw-semibold">Keperluan</label>
                        <div class="col-sm-3">
                            <select name="keperluan" class="form-select form-select-sm" required>
                                <option value="Wisata">Wisata</option>
                                <option value="Pendidikan">Pendidikan</option>
                                <option value="Bekerja">Bekerja</option>
                                <option value="Umroh/Haji">Umroh/Haji</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" name="simpan_berkas" class="btn btn-primary btn-sm px-4 fw-semibold">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data Pendaftar Ulang -->
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title mb-0 fw-semibold">Data Pendaftar Ulang</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0 text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>No. Daftar</th>
                                <th>Nama Pemohon</th>
                                <th>Keperluan</th>
                                <th>KTP</th>
                                <th>KK</th>
                                <th>Ijazah/Akte</th>
                                <th>Keterangan</th>
                                <th>No. Antrian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q_tabel = mysqli_query($conn, "
                                SELECT p.id, p.no_daftar, d.nama_pemohon, p.keperluan, p.ktp, p.kk, p.ijazah, p.keterangan, p.no_antrian 
                                FROM pengurusan p 
                                JOIN pendaftaran d ON p.no_daftar = d.no_daftar
                                ORDER BY p.id ASC
                            ");
                            
                            if(mysqli_num_rows($q_tabel) == 0) {
                                echo "<tr><td colspan='9' class='text-muted py-3'>Belum ada data</td></tr>";
                            } else {
                                while($row = mysqli_fetch_assoc($q_tabel)) {
                                    $badge_ket = ($row['keterangan'] == 'OK') ? 'bg-success' : 'bg-danger';
                                    
                                    echo "<tr>
                                            <td>{$row['no_daftar']}</td>
                                            <td class='text-start fw-semibold'>{$row['nama_pemohon']}</td>
                                            <td>{$row['keperluan']}</td>
                                            <td>{$row['ktp']}</td>
                                            <td>{$row['kk']}</td>
                                            <td>{$row['ijazah']}</td>
                                            <td><span class='badge {$badge_ket}'>{$row['keterangan']}</span></td>
                                            <td class='fw-bold'>{$row['no_antrian']}</td>
                                            <td>
                                                <a href='#' class='text-decoration-none me-2'>edit</a>
                                                <a href='daftar_ulang.php?hapus={$row['id']}' class='text-danger text-decoration-none' onclick=\"return confirm('Yakin ingin menghapus data ini?');\">hapus</a>
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

</body>
</html>