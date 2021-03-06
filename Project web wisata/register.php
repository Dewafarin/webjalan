<?php
include 'function.php';
if(isset($_POST["daftar"])){

    if(register($_POST) > 0){
        echo "<script>alert('User Ditambahkan');
        document.location.href='login';
         </script>";
    }else{
        echo "<script>alert('User Gagal ditambahkan');
       
         </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="styleregister.css">
</head>
<body>
    <div class="boxlogin">
        <img src="img/logobiru.png">

        <h1>DAFTAR</h1>
        <form method="POST" action="">
            <label>Nama Pengguna : </label><br>
            <input type="text" name="username" required maxlength="11"><br>
            <label>E-mail : </label><br>
            <input type="text" name="email"  required><br>
            <label>No. HP : </label><br>
            <input type="text" name="nohp"  required><br>
            <label>Sandi :</label><br>
            <input type="password" name="pass1"  required><br>
            <label>Ketik Ulang Sandi :</label><br>
            <input type="password" name="pass2"  required><br>
            <input type="submit" name="daftar" value="Daftar"><br>
            <div class="link"><a href="login">Masuk</a></div>
        </form>
    </div>
</body>
</html>