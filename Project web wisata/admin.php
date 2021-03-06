<?php
session_start();
include 'function.php';


if(isset($_SESSION["admin"])){
    $email=$_SESSION["email"];
    $userdata=mysqli_query($conn,"SELECT * FROM tb_user WHERE email='$email'");
    $rowuser=mysqli_fetch_assoc($userdata);
    $user=$rowuser["username"];
}

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = "beranda";
}

$datauser=mysqli_query($conn,"SELECT * FROM tb_user");
$jumlahuser=mysqli_num_rows($datauser);
$datafoto=mysqli_query($conn,"SELECT * FROM fotoupload");
$jumlahfoto=mysqli_num_rows($datafoto);



$userdatanew=query("SELECT * FROM tb_user ORDER BY id DESC LIMIT 3");
$alluser=query("SELECT * FROM tb_user ");
$alldestinasi=query("SELECT * FROM destinasi");


$allfoto=query("SELECT * FROM fotoupload");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleadmin.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
 
   
        <div class="container">
            <div id="container1">
                <div class="logo">
                    <a href="admin">
                        <img src="img/logo.png">
                    </a>
                </div><hr>
                <nav>
                    <ul>
                        <?php if($page=="beranda"):?>
                        <a href="admin?page=beranda"><li class="active"><i class="fas fa-fw fa-home"></i> Beranda</li></a>
                        <?php else :?>
                        <a href="admin?page=beranda"><li><i class="fas fa-fw fa-home"></i> Beranda</li></a>
                        <?php endif ;?>

                        <?php if($page=="destinasi"):?>
                        <a href="admin?page=destinasi"><li class="active"><i class="fas fa-fw fa-umbrella-beach"></i> Destinasi</li></a>
                        <?php else :?>
                        <a href="admin?page=destinasi"><li><i class="fas fa-fw fa-umbrella-beach"></i> Destinasi</li></a>   
                        <?php endif ;?>

                        <?php if($page=="pengguna"):?>
                        <a href="admin?page=pengguna"><li class="active"><i class="fas fa-fw fa-users"></i> Pengguna</li></a>
                        <?php else :?>
                        <a href="admin?page=pengguna"><li><i class="fas fa-fw fa-users"></i> Pengguna</li></a>
                        <?php endif ;?>

                        <?php if($page=="foto"):?>
                        <a href="admin?page=foto"><li class="active"><i class="fas fa-fw fa-camera-retro"></i> Foto</li></a>
                        <?php else :?>
                        <a href="admin?page=foto"><li><i class="fas fa-fw fa-camera-retro"></i> Foto</li></a>
                        <?php endif ;?>

                        <a href="logout"><li><i class="fas fa-fw fa-sign-out-alt"></i> Keluar</li></a>
                    </ul>      
                </nav>
            </div>
            <div id="profile">
    
                    <ul>
                        <a href="profileadmin"><li>Profile saya</li></a>
                        <a href="switchacc"><li>Ganti akun</li></a>                 
                    </ul>
       
            </div>
            <div id="container2">

            <?php
            if(isset($_GET['page'])){

            switch($page){
                case 'beranda':
                    include "page/home.php";
                    break;
                case 'destinasi':
                    include "page/destinasiweb.php";
                    break;
                case 'pengguna':
                    include "page/user.php";
                    break;
                case 'foto':
                    include "page/foto.php";
                    break;
                default:
                    echo "<center><h3>Maaf. Halaman tidak ditemukan</h3></center>";
                }
            }else{
                include "page/home.php";
            
            }
            ?>
            </div>
        </div>
 
    
</body>
</html>
