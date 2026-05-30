<?php

$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

$query = mysqli_query($con, "UPDATE tbl_mhs SET Age = '66' WHERE FirstName = 'Dwi' AND LastName = 'Ihwanto'");

if ($query) {
    echo "Data mahasiswa bernama Dwi Ihwanto berhasil diperbarui!";
} else {
    echo "Gagal memperbarui data: " . mysqli_error($con);
}

mysqli_close($con);
?>