<?php
session_start();
if(isset($_SESSION["pesan_nama"]) || isset($_SESSION["pesan_nim"]) || isset($_SESSION["pesan_email"])) {
    if(isset($_SESSION["pesan_nama"])) {
        $pesan_nama = $_SESSION["pesan_nama"];
    }else {
        $pesan_nama = "";
    }
    if(isset($_SESSION["pesan_nim"])) {
        $pesan_nim = $_SESSION["pesan_nim"];
    }else {
        $pesan_nim = "";
    }
    if(isset($_SESSION["pesan_email"])) {
        $pesan_email = $_SESSION["pesan_email"];
    }else {
        $pesan_email = "";
    }
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Registrasi</title>
    <style type="text/css">
        input[type=text],input[type=password],select {
            width: 230px;
            height: 20px;
        }
    </style>
</head>
<body>
    <form action="submit.php" method="post">
        <h2 align="center">Form Registrasi</h2>
        <table align="center" cellpadding="5">
			<tr>
				<td valign="top" width="40%">Username *</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password *</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td valign="top">Nama</td>
				<td>
                    <input type="text" name="nama">
                    <?php if(isset($_SESSION["pesan_nama"])) { ?>
                    <p style="color: red;font-size: 12px"><?php echo $pesan_nama ?></p>
                    <?php } ?>
                </td>
			</tr>
			<tr>
				<td valign="top">NIM</td>
				<td>
                    <input type="text" name="nim">
                    <?php if(isset($_SESSION["pesan_nim"])) { ?>
                    <p style="color: red;font-size: 12px"><?php echo $pesan_nim ?></p>
                    <?php } ?>
                </td>
			</tr>
			<tr>
				<td valign="top">Kelas</td>
				<td>
					<input type="radio" name="kelas" value="1">01
					<input type="radio" name="kelas" value="2">02
					<input type="radio" name="kelas" value="3">03
					<input type="radio" name="kelas" value="4">04
				</td>
			</tr>
			<tr>
				<td valign="top">Jenis Kelamin</td>
				<td>
					<input type="radio" name="jk" value="laki-laki">Laki-laki
					<input type="radio" name="jk" value="perempuan">Perempuan
				</td>
			</tr>
			<tr>
				<td valign="top">Hobi</td>
				<td>
					<input type="checkbox" name="hobi[]" value="Olahraga">Olahraga<br>
					<input type="checkbox" name="hobi[]" value="Membaca">Membaca<br>
					<input type="checkbox" name="hobi[]" value="Menulis">Menulis<br>
					<input type="checkbox" name="hobi[]" value="Bercerita">Bercerita<br>
					<input type="checkbox" name="hobi[]" value="Berkomedi">Berkomedi<br>
				</td>
			</tr>
			<tr>
				<td valign="top">Fakultas</td>
				<td>
					<select name="fak">
						<option value="">--</option>
						<option value="Ilmu Terapan">Ilmu Terapan</option>
						<option value="Informatika">Informatika</option>
						<option value="Teknik Elektro">Teknik Elektro</option>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top">Alamat</td>
				<td><textarea name="alamat" id="" cols="26" rows="3"></textarea></td>
			</tr>
			<tr>
				<td align="right" colspan="2"><input type="submit" name="submit" value="Kirim"></td>
			</tr>
        </table>
    </form>
</body>
</html>