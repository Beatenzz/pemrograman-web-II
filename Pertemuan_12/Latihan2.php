<?php

$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

$query = mysqli_query($con, "DELETE FROM tbl_mhs WHERE LastName='Arif'");

if ($query) {
    echo "Data mahasiswa dengan nama belakang 'Arif' berhasil dihapus!";
} else {
    echo "Gagal menghapus data: " . mysqli_error($con);
}

mysqli_close($con);
?>