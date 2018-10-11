<?php
session_start();
require_once("db.php");

if(isset($_POST["submit"]) && !isset($_POST["edit"]) && !isset($_POST["post"]) && !isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $kelas = $_POST["kelas"];
    $jk = $_POST["jk"];
    $hobi = $_POST["hobi"];
    $fakultas = $_POST["fak"];
    $alamat = $_POST["alamat"];

    $inputlagi = "<br><a href='register.php'>Input Lagi</a>";
	$br = "<br>";
	if (strlen($nama) > 35 || $nama == "") {
		$_SESSION["pesan_nama"] = "Nama tidak boleh lebih dari 35 huruf.";
		header("Location: register.php");
	}
	if (!is_numeric($nim) || strlen((string)$nim) > 10) {
		$_SESSION["pesan_nim"] = "Nim harus angka dan tidak lebih dari 10 digit.";
		header("Location: register.php");
	}else {
        $query = "INSERT INTO user VALUES ('$username','$password','$nama',$nim,'$kelas','$jk','" . implode(", ",$hobi) . "','$fakultas','$alamat')";

        if (mysqli_query($connection, $query)) {
            mysqli_close($connection);
            echo "<p style='font-size: 20px;text-align: center'>Data baru berhasil dibuat</p>";
            echo "<p style='font-size: 20px;text-align: center'>Silahkan <a href='login.php'>login</a> untuk melanjutkan</p>";
        }else {
            echo "Error: " . $query . "<br>" . mysqli_error($connection);
        }
    }
}else if(isset($_POST["edit"]) && $_POST["edit"] == "edit") {
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $kelas = $_POST["kelas"];
    $jk = $_POST["jk"];
    $hobi = $_POST["hobi"];
    $fakultas = $_POST["fak"];
    $alamat = $_POST["alamat"];

    $query = "UPDATE user SET nama='$nama', kelas='$kelas', jk='$jk', hobi='" . implode(", ",$hobi) . "', fakultas='$fakultas', alamat='$alamat' WHERE nim='$nim'";

    if (mysqli_query($connection, $query)) {
        mysqli_close($connection);
        $_SESSION["user_nama"] = $nama;
        $_SESSION["profile_edit_success"] = "Data anda berhasil diperbarui";
        header("Location: /");
    }else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
}else if(isset($_POST["post"])) {
    $judul = $_POST["judul"];
    $isi = $_POST["isi"];
    $nim = $_POST["nim"];
    $gambar = $_FILES["gambar"];
    $dir = "uploads/";
    $img_name = preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime()) . "_" . chr(rand(97,122)) . "." . pathinfo($gambar["name"], PATHINFO_EXTENSION);
    $img_tmp = $gambar["tmp_name"];
    $target_file = $dir . $img_name;

    if(count(explode(" ",$isi)) < 30) {
        $_SESSION["post_error"] = "Isi tidak boleh kurang dari 30 kata.";
        header("Location: posting.php");
    }else {
        if (move_uploaded_file($img_tmp, $target_file)) {

            $query = "INSERT INTO posting VALUES('','$judul','$isi','$nim','$img_name')";

            if (mysqli_query($connection, $query)) {
                mysqli_close($connection);
                $_SESSION["post_success"] = "Posting ". $judul ." berhasil ditambahkan.";
                header("Location: daftarposting.php");
            }else {
                echo "Gagal";
            }
        }else {
            echo "Gagal Upload";
        }
    }
}else if(isset($_GET["post_id"]) && $_GET["delete"] == true) {
    $id = $_GET["post_id"];
    $gambar = $_GET["gambar_name"];
    $query = "DELETE FROM posting WHERE id=$id";
    if (mysqli_query($connection, $query) && unlink("uploads/".$gambar)) {
        mysqli_close($connection);
        $_SESSION["post_delete_success"] = "Posting ". $judul ." berhasil dihapus.";
        header("Location: daftarposting.php");
    }else {
        echo "Gagal";
    }
}else if (isset($_POST["edit"]) && $_POST["edit"] == true) {
    $id = $_POST["post_id"];
    $judul = $_POST["judul"];
    $isi = $_POST["isi"];

    $query = "UPDATE posting SET judul='$judul', isi='$isi' WHERE id=$id";
    if(count(explode(" ",$isi)) < 30) {
        $_SESSION["post_error"] = "Isi tidak boleh kurang dari 30 kata.";
        header("Location: posting.php?post_id=". $id ."&edit=true");
    }else {
        if (mysqli_query($connection, $query)) {
            mysqli_close($connection);
            $_SESSION["post_edit_success"] = "Berhasil memperbarui post " . $judul;
            header("Location: daftarposting.php");
        }else {
            echo "Gagal" . $query . "<br>" . mysqli_error($connection);
        }
    }
}else if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $query = "SELECT username, password, nim, nama FROM user WHERE username='$username' and password='$password'";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION["user_nim"] = $row["nim"];
        $_SESSION["user_nama"] = $row["nama"];
        $_SESSION["logged_in"] = true;
        header("Location: /");
    }else {
        $_SESSION["pesan_login"] = "Username atau password salah atau tidak ditemukan";
        header("Location: login.php");
    }
}else {
    echo "<p style='font-size: 20px;text-align: center'>Anda tersesat</p>";
    echo "<p style='font-size: 20px;text-align: center'><a href='register.php'>Registrasi</a> | <a href='login.php'>Login</a>";
}