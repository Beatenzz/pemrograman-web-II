<?php
// Fungsi repeat dengan nilai default untuk $num adalah 10
function repeat($text, $num = 10) 
{
    echo "<ol>\r\n"; 
    for($i = 0; $i < $num; $i++) 
    {
        echo "<li>$text </li>\r\n"; 
    }
    echo "</ol>"; 
}

// Memanggil dengan dua argumen (num diisi 15)
repeat("I'm the best", 15); 

echo "<hr>";

// Memanggil dengan satu argumen (num akan otomatis menggunakan default 10)
repeat("You're the man"); 
?>