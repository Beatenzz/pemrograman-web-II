<?php
$con = mysql_connect("localhost", "root", "");
mysql_select_db("lat_dbase", $con);[cite: 16, 17]

mysql_query("INSERT INTO tbl_mhs (FirstName, LastName, Age) 
             VALUES ('Karina', 'Suwandi', '29')");[cite: 16, 17]
mysql_query("INSERT INTO tbl_mhs (FirstName, LastName, Age) 
             VALUES ('Glenn', 'Gandari', '32')");[cite: 16, 17]

mysql_close($con); // Menutup koneksi
?>