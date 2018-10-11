<?php
session_start();
if(isset($_SESSION["logged_in"])){
echo "<p style='font-size: 20px;text-align: center'>Anda telah login, untuk apa login lagi?</p>";
echo "<p style='font-size: 20px;text-align: center'><a href='logout.php'>Logout</a> | <a href='index.php'>Index</a></p>";
}else {
if(isset($_SESSION["pesan_login"])) {
    $pesan_login = $_SESSION["pesan_login"];
}else {
    $pesan_login = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<style type="text/css">
    input[type=text],input[type=password],select {
        width: 180px;
        height: 20px;
    }
</style>
</head>
<body>
<form action="submit.php" method="post">
    <h2 align="center">Masuk</h2>
    <?php if(isset($_SESSION["pesan_login"])) { ?>
    <center>
    <p align="center" style="margin-top: 0;padding: 0 10px 0 10px;display:inline-block;line-height: 35px;background: #FFBABA;color: #D8000C"><?php echo $pesan_login; ?></p>
    </center>
    <?php } ?>
    <table align="center" cellpadding="5">
        <tr>
            <th colspan="2" align="left">Username</th>
        </tr>
        <tr>
            <td colspan="2"><input type="text" name="username"></td>
        </tr>
        <tr>
            <th align="left" colspan="2">Password</th>
        </tr>
        <tr>
            <td colspan="2"><input type="password" name="password"></td>
        </tr>
        <tr>
            <td align="left"><a href="register.php">Registrasi</a></td>
            <input type="hidden" name="login" value="true">
            <td align="right"><input type="submit" name="submit" value="Masuk"></td>
        </tr>
    </table>
</form>
</body>
</html>
<?php unset($_SESSION["pesan_login"]); } ?>