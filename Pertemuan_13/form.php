<html>
<head>
    <title>Form Input Data Mahasiswa</title>
    <style type="text/css">
        table { font-family: Verdana, Arial, sans-serif; font-size: 11px; }
        input, select { font-family: Verdana, Arial, sans-serif; font-size: 11px; height: 24px; }
    </style>
</head>
<body>
    <div style="border:0; padding:10px; width:760px; margin:0 auto;">
        <form action="action_input_data.php" method="POST" name="form-input-data">
            <table width="760" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr height="46">
                    <td width="10%">&nbsp;</td>
                    <td width="25%">&nbsp;</td>
                    <td width="65%"><font color="orange" size="4"><b>Form Input Data Mahasiswa</b></font></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>ID Mahasiswa / NIM</td>
                    <td><input type="text" name="id_mahasiswa" size="35" maxlength="6" required /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Nama</td>
                    <td><input type="text" name="nama" size="50" maxlength="30" required /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Jurusan</td>
                    <td>
                        <select name="jurusan">
                            <option value="-">- Pilih Jurusan -</option>
                            <option value="Teknik Komputer">Teknik Komputer</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                            <option value="Komputer Akuntansi">Komputer Akuntansi</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" size="50" maxlength="30" required /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>No. Telp</td>
                    <td><input type="text" name="telepon" size="20" maxlength="12" required /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" name="Submit" value="Submit">
                        <input type="reset" name="reset" value="Cancel">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>