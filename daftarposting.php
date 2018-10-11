<?php
session_start();
require_once("db.php");
if(isset($_SESSION["user_nim"])) {
if (isset($_SESSION["post_success"]) || isset($_SESSION["post_edit_success"]) || isset($_SESSION["post_delete_success"])) {
    if (isset($_SESSION["post_success"])) {
        $post_success = $_SESSION["post_success"];
    }else {
        $post_success = "";
    }
    if (isset($_SESSION["post_edit_success"])) {
        $post_edit_success = $_SESSION["post_edit_success"];
    }else {
        $post_edit_success = "";
    }
    if (isset($_SESSION["post_delete_success"])) {
        $post_delete_success = $_SESSION["post_delete_success"];
    }else {
        $post_delete_success = "";
    }
}

$nim = $_SESSION["user_nim"];

$query = "SELECT b.nama, a.* FROM posting a JOIN user b ON a.nim = b.nim WHERE a.nim=$nim";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Post <?php echo $_SESSION["user_nama"] ?></title>
</head>
<body>
    <?php include_once("menu.php") ?>
    <?php if (isset($_SESSION["post_success"])):?>
    <center>
        <p align="center" style="padding: 0 10px 0 10px;display:inline-block;line-height: 35px;background: #DFF2BF;color: #270">
            <?php echo $post_success ?>
        </p>
    </center>
    <?php endif; ?>
    <?php if (isset($_SESSION["post_edit_success"])):?>
    <center>
        <p align="center" style="padding: 0 10px 0 10px;display:inline-block;line-height: 35px;background: #DFF2BF;color: #270">
            <?php echo $post_edit_success ?>
        </p>
    </center>
    <?php endif; ?>
    <?php if (isset($_SESSION["post_delete_success"])):?>
    <center>
        <p align="center" style="padding: 0 10px 0 10px;display:inline-block;line-height: 35px;background: #DFF2BF;color: #270">
            <?php echo $post_delete_success ?>
        </p>
    </center>
    <?php endif; ?>
    <table width="80%" align="center" border=1 cellpadding="6" style="border-collapse: collapse;">
        <tr>
            <th width="3%">No.</th>
            <th>Judul</th>
            <th width="36%">Isi</th>
            <th width="11%">Penulis</th>
            <th width="120px">Gambar</th>
            <th width="9%">Aksi</th>
        </tr>
    <?php 
    if (mysqli_num_rows($result) > 0) {
        $i = 0;
        while($i < mysqli_num_rows($result)) { 
            $row = mysqli_fetch_assoc($result);     
    ?>
        <tr>
            <td align="center">
            <?php echo $i+1 . "." ?>
            </td>
            <td><b><?php echo $row["judul"] ?></b></td>
            <td><?php echo implode(" ",array_slice(explode(" ",$row["isi"]),0,20)) . " [...]" ?></td>
            <td align="center"><?php echo $row["nama"] ?></td>
            <td align="center"><img height="60px" width="110px" border="1" src="uploads/<?php echo $row['gambar'] ?>" alt=""></td>
            <?php $id = $row["id"] ?>
            <td align="center">
                <a href="posting.php?post_id=<?php echo $id ?>&edit=true">Edit</a> | 
                <a href="submit.php?post_id=<?php echo $id ?>&delete=true&gambar_name=<?php echo $row["gambar"] ?>">Delete</a>
            </td>
        </tr>
    <?php 
        $i++;
        }
    unset($_SESSION["post_success"]);
    unset($_SESSION["post_edit_success"]);
    unset($_SESSION["post_delete_success"]);
    }else {
    ?>
        <tr>
            <td colspan="6" align="center">0 results.</td>
        </tr>
    <?php
    }
    ?>
    </table>
</body>
</html>
<?php 
}else {
    header("Location: login.php");
}
?>