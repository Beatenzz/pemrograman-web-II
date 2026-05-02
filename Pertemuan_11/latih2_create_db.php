<?php
mysql_connect("localhost", "root", ""); // Buka koneksi
$dbname = "lat_dbase";[cite: 17]

// Eksekusi perintah SQL
$cek = mysql_query("CREATE DATABASE $dbname") 
       or die("Couldn't Create Database: $dbname");

if ($cek) {
    echo "Database $dbname berhasil dibuat";[cite: 17]
}
?>