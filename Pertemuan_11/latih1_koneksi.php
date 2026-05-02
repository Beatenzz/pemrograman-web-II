<?php
$servername = 'localhost'; // Host server
$dbusername = 'root';      // Username default XAMPP
$dbpassword = '';          // Password default biasanya kosong

// Mencoba koneksi
$link = mysql_connect("$servername", "$dbusername", "$dbpassword") 
        or die("Not able to connect to server"); 

if ($link) {
    echo "ok....koneksi berhasil";
}
?>