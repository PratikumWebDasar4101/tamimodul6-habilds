<?php
session_start();
require_once("db.php");

if(isset($_SESSION["user_nim"])) {

$query = "SELECT b.nama, a.* FROM posting a JOIN user b ON a.nim=b.nim";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Semua Post</title>
</head>
<body>
    <?php include_once("menu.php") ?>
    <table width="80%" align="center" border=1 cellpadding="6" style="border-collapse: collapse;">
        <tr>
            <th width="3%">No.</th>
            <th>Judul</th>
            <th width="40%">Isi</th>
            <th width="11%">Penulis</th>
            <th width="120px">Gambar</th>
        </tr>
    <?php 
    if (mysqli_num_rows($result) > 0) {
        $i = 0;
        while($i < mysqli_num_rows($result)) {   
            $row = mysqli_fetch_assoc($result);    
    ?>
        <tr>
            <td align="center">
            <?php 
                echo $i+1 . ".";
            ?>
            </td>
            <td><b><?php echo $row["judul"] ?></b></td>
            <td><?php echo implode(" ",array_slice(explode(" ",$row["isi"]),0,20)) . " [...]" ?></td>
            <td align="center"><?php echo $row["nama"] ?></td>
            <td align="center"><img height="60px" width="120px" border="1" src="uploads/<?php echo $row['gambar'] ?>" alt=""></td>
        </tr>
    <?php 
        $i++;
        }
    }else {
    ?>
        <tr>
            <td colspan="5" align="center">0 results.</td>
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