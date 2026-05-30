<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Input Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 50px;
        }
        .form-container {
            width: 600px;
            margin: 0 auto;
        }
        .form-title {
            color: #f0a500; /* Warna oranye sesuai gambar */
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
            vertical-align: middle;
            font-size: 14px;
        }
        .label-cell {
            width: 35%;
        }
        input[type="text"], select {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        /* Responsif khusus untuk input No Telp agar lebih pendek sesuai gambar */
        .short-input {
            width: 50% !important;
        }
        .button-container {
            text-align: center;
            padding-top: 20px;
        }
        .btn {
            padding: 5px 15px;
            margin: 0 5px;
            border: 1px solid #777;
            background-color: #e1e1e1;
            cursor: pointer;
            border-radius: 3px;
            box-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }
        .btn:hover {
            background-color: #d4d4d4;
        }
        .result-box {
            margin-top: 30px;
            padding: 15px;
            border: 1px dashed #f0a500;
            background-color: #fffdf5;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="form-title">Form Input Data Mahasiswa</div>
    
    <form action="" method="POST">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="label-cell">ID Mahasiswa / NIM</td>
                <td><input type="text" name="nim" required></td>
            </tr>
            <tr>
                <td class="label-cell">Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td class="label-cell">Jurusan</td>
                <td>
                    <select name="jurusan" required>
                        <option value="">- Pilih Jurusan -</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Sistem Komputer">Sistem Komputer</option>
                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label-cell">Alamat</td>
                <td><input type="text" name="alamat" required></td>
            </tr>
            <tr>
                <td class="label-cell">No. Telp</td>
                <td><input type="text" name="no_telp" class="short-input" required></td>
            </tr>
            <tr>
                <td colspan="2" class="button-container">
                    <input type="submit" name="submit" value="Submit" class="btn">
                    <input type="reset" value="Cancel" class="btn">
                </td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $nim = htmlspecialchars($_POST['nim']);
        $nama = htmlspecialchars($_POST['nama']);
        $jurusan = htmlspecialchars($_POST['jurusan']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $no_telp = htmlspecialchars($_POST['no_telp']);

        echo "<div class='result-box'>";
        echo "<strong>Data Berhasil Diterima:</strong><br><br>";
        echo "NIM: " . $nim . "<br>";
        echo "Nama: " . $nama . "<br>";
        echo "Jurusan: " . $jurusan . "<br>";
        echo "Alamat: " . $alamat . "<br>";
        echo "No. Telp: " . $no_telp . "<br>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>