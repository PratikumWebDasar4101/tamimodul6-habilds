<?php
session_start();
require_once("db.php");

if (isset($_SESSION["user_nim"])) {
    if (isset($_GET["post_id"]) && $_GET["edit"] == true) {
        $id = $_GET["post_id"];
        $query = "SELECT * FROM posting WHERE id=$id";

        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $judul = $row["judul"];
        $isi = $row["isi"];
    }
    if (isset($_SESSION["post_error"])) {
        $post_error = $_SESSION["post_error"];
    }else {
        $post_error = "";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tulis Cerita</title>
    <style>
        input[type=text] {
            width: 500px;
            font-size: 16px;
        }
        input {
            height: 30px;
        }
    </style>
</head>
<body>
    <?php include_once("menu.php") ?>
    <h2 align="center">Tulis Cerita</h2>
    <form action="submit.php" method="post" enctype="multipart/form-data">
        <table align="center" width="80%" cellpadding="8">
            <tr>
                <td><h3 style="margin: 0">Judul</h3></td>
            </tr>
            <tr>
                <td><input type="text" name="judul" <?php if(isset($_GET["edit"])):echo "value='$judul'";endif ?>></td>
            </tr>
            <tr>
                <td><input type="file" name="gambar" id="gambar"></td>
            </tr>
            <?php if (isset($_SESSION["post_error"])):?>
            <tr>
                <td>
                <p align="center" style="margin: 0;padding: 0 10px 0 10px;display:inline-block;line-height: 35px;background: #FFBABA;color: #D8000C">
                    <?php echo $post_error ?>
                </p>
                </td>
            </tr>                
            <?php endif ?>
            <?php if (!isset($_SESSION["post_error"])):?>
            <tr>
                <td>
                    <cite>Isi harus lebih dari 30 kata.</cite>
                </td>
            </tr>
            <?php endif ?>
            <tr>
                <td><textarea name="isi" id="" cols="80" rows="20"><?php if(isset($_GET["edit"])):echo "$isi";endif ?></textarea></td>
            </tr>
            <tr>
            <?php if(isset($_GET["edit"])) {?>
                <input type="hidden" name="edit" value="true">
                <input type="hidden" name="post_id" value="<?php echo $id ?>">
            <?php }else {?>
                <input type="hidden" name="post" value="post">
            <?php } ?>
                <input type="hidden" name="nim" value="<?php echo $_SESSION["user_nim"] ?>">
                <td><input type="submit" name="submit" value="Posting"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php unset($_SESSION["post_error"]); 
}else {
    header("Location: login.php");
}
?>