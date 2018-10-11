<?php
session_start();
require_once("db.php");

if(isset($_SESSION["user_nim"])) {
	$nim = $_SESSION["user_nim"];
    $query = "SELECT * FROM user WHERE nim=$nim";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil <?php echo $row["nama"] ?></title>
    <style type="text/css">
        input[type=text],input[type=password],select {
            width: 230px;
            height: 20px;
        }
    </style>
</head>
<body>
<?php include_once("menu.php") ?>
<form action="submit.php" method="post">
        <table width="80%" align="center" cellpadding="4">
			<tr>
				<td><h2>Edit Profil</h2></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td width="80%">
                    <input type="text" name="nama" value="<?php echo $row["nama"] ?>">
                    <?php if(isset($_SESSION["pesan_nama"])) { ?>
                    <p style="color: red;font-size: 12px"><?php echo $pesan_nama ?></p>
                    <?php } ?>
                </td>
			</tr>
			<tr>
				<td>NIM</td>
				<td>
                    <input type="text" value="<?php echo $row["nim"] ?>" disabled>
                </td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td>
					<input type="radio" name="kelas" value="1" <?php if($row["kelas"] == 1):echo "checked"; endif ?>>01
					<input type="radio" name="kelas" value="2" <?php if($row["kelas"] == 2):echo "checked"; endif ?>>02
					<input type="radio" name="kelas" value="3" <?php if($row["kelas"] == 3):echo "checked"; endif ?>>03
					<input type="radio" name="kelas" value="4" <?php if($row["kelas"] == 4):echo "checked"; endif ?>>04
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>
					<input type="radio" name="jk" value="laki-laki" <?php if($row["jk"] == "laki-laki"):echo "checked"; endif ?>>Laki-laki
					<input type="radio" name="jk" value="perempuan" <?php if($row["jk"] == "perempuan"):echo "checked"; endif ?>>Perempuan
				</td>
			</tr>
			<tr>
				<td valign="top">Hobi</td>
                <?php $hobi = explode(", ",$row["hobi"]); ?>
				<td>
					<input type="checkbox" name="hobi[]" value="Olahraga" <?php if(in_array("Olahraga",$hobi)):echo "checked"; endif ?>>Olahraga<br>
					<input type="checkbox" name="hobi[]" value="Membaca" <?php if(in_array("Membaca",$hobi)):echo "checked"; endif ?>>Membaca<br>
					<input type="checkbox" name="hobi[]" value="Menulis" <?php if(in_array("Menulis",$hobi)):echo "checked"; endif ?>>Menulis<br>
					<input type="checkbox" name="hobi[]" value="Bercerita" <?php if(in_array("Bercerita",$hobi)):echo "checked"; endif ?>>Bercerita<br>
					<input type="checkbox" name="hobi[]" value="Berkomedi" <?php if(in_array("Berkomedi",$hobi)):echo "checked"; endif ?>>Berkomedi<br>
				</td>
			</tr>
			<tr>
				<td>Fakultas</td>
				<td>
					<select name="fak">
						<option value="Ilmu Terapan" <?php if($row["fakultas"] == "Ilmu Terapan"):echo "selected";endif ?>>Ilmu Terapan</option>
						<option value="Informatika" <?php if($row["fakultas"] == "Informatika"):echo "selected";endif ?>>Informatika</option>
						<option value="Teknik Elektro" <?php if($row["fakultas"] == "Teknik Elektro"):echo "selected";endif ?>>Teknik Elektro</option>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top">Alamat</td>
				<td><textarea name="alamat" id="" cols="26" rows="3"><?php echo $row["alamat"] ?></textarea></td>
			</tr>
			<tr>
                <input type="hidden" name="nim" value="<?php echo $row["nim"] ?>">
                <input type="hidden" name="edit" value="edit">
				<td><input type="submit" name="submit" value="Kirim"></td>
			</tr>
        </table>
    </form>
</body>
</html>
<?php 
}else {
    header("Location: index.php");
} ?>