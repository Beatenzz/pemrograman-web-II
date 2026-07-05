<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 12345;
    $_SESSION['role'] = 'Business Development';
}

echo "<html><body>";
echo "<h2>Selamat Datang</h2>";
echo "Session Anda telah aktif.";
echo "</body></html>";
?>