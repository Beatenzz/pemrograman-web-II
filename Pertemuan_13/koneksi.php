<?php
include "koneksi.php";

if (isset($_POST['Submit']) && $_POST['Submit'] == "Submit") {
    $id_mahasiswa = $_POST['id_mahasiswa']; 
    $nama = $_POST['nama']; 
    $jurusan = $_POST['jurusan']; 
    $alamat = $_POST['alamat']; 
    $telepon = $_POST['telepon']; 

    // Validasi data kosong 
    if (empty($id_mahasiswa) || empty($nama) || empty($alamat) || empty($telepon)) { 
        echo "<script>
                alert('Data Harap Dilengkapi!');
                document.location='form_mahasiswa.php';
              </script>";
    } else {
        // Cek NIM di database agar tidak duplikat 
        $query_cek = "SELECT id_mahasiswa FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'"; 
        $cek = mysql_num_rows(mysql_query($query_cek)); 
        
        if ($cek > 0) { 
            echo "<script>
                    alert('NIM sudah dipakai!, silahkan ganti NIM yang lain');
                    document.location='form_mahasiswa.php';
                  </script>"; 
        } else {
            $input = "INSERT INTO mahasiswa (id_mahasiswa, nama, jurusan, alamat, telepon) 
                      VALUES ('$id_mahasiswa', '$nama', '$jurusan', '$alamat', '$telepon')"; 
            $query_input = mysql_query($input); 
            
            if ($query_input) {
                echo "<script>
                        alert('Input Data Mahasiswa Berhasil');
                        document.location='form_mahasiswa.php';
                      </script>"; 
            } else { 
                echo "Input Data Mahasiswa Gagal!, Silahkan diulangi!"; 
            }
        }
    }
}
mysql_close($Open); // Tutup koneksi engine MySQL
?>