<?php
mysql_connect("localhost", "root", "");
// mysql_db_query menyatukan select_db dan query
$hasil = mysql_db_query("lat_dbase", "select * from tbl_mhs"); 

while ($data = mysql_fetch_row($hasil)) {
    echo "$data[0] $data[1] $data[2]<br>"; // Mengakses via indeks angka
}
?>