<?php
$A = 123; // variabel global [cite: 773]

function Test() {
    global $A; // Menghubungkan ke variabel global di luar fungsi [cite: 775]
    echo "Nilai A dalam fungsi = $A <br>"; // Mencetak 123 [cite: 776, 781]
}

Test(); [cite: 778]
echo "Nilai A luar fungsi = $A"; // Mencetak 123 [cite: 779, 782]
?>