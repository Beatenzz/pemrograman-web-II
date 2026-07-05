<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengurusan - Pengajuan Paspor</title>
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
            <a href="index.php" class="btn btn-outline-secondary btn-sm me-1 fw-semibold">Daftar</a>
            <a href="daftar_ulang.php" class="btn btn-outline-secondary btn-sm me-1 fw-semibold">Daftar Ulang</a>
            <a href="pengurusan.php" class="btn btn-primary btn-sm fw-semibold">Pengurusan</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0 fw-semibold">Data Pengurusan Paspor</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">No. Antrian</th>
                                <th class="text-center">No. Daftar</th>
                                <th>Nama Pemohon</th>
                                <th>Berkas</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th class="text-end">Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Melakukan JOIN untuk mengambil Nama Pemohon dari tabel pendaftaran
                            $query = mysqli_query($conn, "
                                SELECT p.no_antrian, p.no_daftar, d.nama_pemohon, p.berkas, p.status, p.keterangan, p.pembayaran 
                                FROM pengurusan p 
                                JOIN pendaftaran d ON p.no_daftar = d.no_daftar
                                ORDER BY p.id ASC
                            ");
                            
                            $total_pendapatan = 0;

                            if(mysqli_num_rows($query) == 0) {
                                echo "<tr><td colspan='7' class='text-center text-muted py-3'>Belum ada data pengurusan paspor</td></tr>";
                            } else {
                                while($row = mysqli_fetch_assoc($query)) {
                                    $total_pendapatan += $row['pembayaran'];
                                    
                                    // Pewarnaan Badge untuk Status
                                    $badge_status = ($row['status'] == 'diterima') ? 'bg-success' : 'bg-danger';
                                    $badge_ket = ($row['keterangan'] == 'OK') ? 'bg-primary' : 'bg-secondary';

                                    echo "<tr>
                                            <td class='text-center fw-bold'>{$row['no_antrian']}</td>
                                            <td class='text-center'>{$row['no_daftar']}</td>
                                            <td class='fw-semibold'>{$row['nama_pemohon']}</td>
                                            <td class='text-capitalize'>{$row['berkas']}</td>
                                            <td><span class='badge {$badge_status}'>{$row['status']}</span></td>
                                            <td><span class='badge {$badge_ket}'>{$row['keterangan']}</span></td>
                                            <td class='text-end fw-semibold'>Rp " . number_format($row['pembayaran'], 0, ',', '.') . "</td>
                                          </tr>";
                                }
                            }
                            ?>
                        </tbody>
                        <?php if(mysqli_num_rows($query) > 0): ?>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="6" class="text-end fw-bold">Total Pendapatan:</th>
                                <th class="text-end fw-bold text-success fs-5">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></th>
                            </tr>
                        </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>
</html>