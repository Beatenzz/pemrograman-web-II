<?php
$A = 123; // variabel global [cite: 761]

function Test() {
    $A = "Test"; // variabel local [cite: 763]
    echo "Nilai A dalam fungsi = $A <br>"; // Mencetak "Test" [cite: 764, 769]
}

Test(); [cite: 766]
echo "Nilai A luar fungsi = $A"; // Mencetak 123 [cite: 767, 770]
?>