<?php
session_start();
require_once("db.php");

if (isset($_SESSION["profile_edit_success"])) {
    $profile_edit_success = $_SESSION["profile_edit_success"];
}else {
    $profile_edit_success = "";
}

if (isset($_SESSION["user_nim"])) {
    $nim = $_SESSION["user_nim"];
    $query = "SELECT * FROM user WHERE nim=$nim";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Index</title>
</head>
<body>
    <?php include_once("menu.php") ?>
    <table width="80%" align="center" cellpadding="3" style="font-size: 18px">
        <tr>
            <td colspan="2"><h2 style="margin: 0"><?php echo $row["nama"] ?>: Profil</h2></td>
        </tr>
        <tr>
            <td colspan="2"><h3>Informasi Pribadi</h3></td>
        </tr>
        <?php if (isset($_SESSION["profile_edit_success"])):?>
        <tr>
            <td colspan="2">
                <p align="center" style="margin-top: 0;padding: 0 10px 0 10px;display:inline-block;line-height: 35px;background: #DFF2BF;color: #270">
                    <?php echo $profile_edit_success ?>
                </p>
            </td>
        </tr>
        <?php endif ?>
        <tr>
            <td width="10%">Nama</td>
            <td><?php echo $row["nama"] ?></td>
        </tr>
        <tr>
            <td width="10%">NIM</td>
            <td><?php echo $row["nim"] ?></td>
        </tr>
        <tr>
            <td width="10%">Kelas</td>
            <td><?php echo $row["kelas"] ?></td>
        </tr>
        <tr>
            <td width="10%">Jenis Kelamin</td>
            <td><?php echo $row["jk"] ?></td>
        </tr>
        <tr>
            <td width="10%">Hobi</td>
            <td><?php echo $row["hobi"] ?></td>
        </tr>
        <tr>
            <td width="10%">Fakultas</td>
            <td><?php echo $row["fakultas"] ?></td>
        </tr>
        <tr>
            <td width="10%">Alamat</td>
            <td><?php echo $row["alamat"] ?></td>
        </tr>
    </table>
</body>
</html>
<?php
unset($_SESSION["profile_edit_success"]);
}else {
    header("Location: login.php");
}