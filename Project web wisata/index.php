<?php
session_start();
require "function.php";

if(isset($_POST["cari"])){
     $lokasi=($_POST["lokasi"]); 
    if(empty(trim($lokasi))){
        false;
    }else{
        header("Location:result?lokasi=$lokasi");
    }
    
    
}

if(isset($_SESSION["login"])){
    $email=$_SESSION["email"];
    $userdata=mysqli_query($conn,"SELECT * FROM tb_user WHERE email='$email'");
    $rowuser=mysqli_fetch_assoc($userdata);
    $user=$rowuser["username"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalan jalan</title>
    <link rel="stylesheet" type="text/css" href="stylee.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">

</head>
<body>  
    <header class="default">
        <div class="container">
            <div class="head" >
                <a href="index">
                    <img src="img/logoputih.png" class="default">
                </a>  
                <ul>
                    <li><a href="">Beranda</a></li>
                    <li><a href="result">Destinasi</a></li>
                    <li><a href="pengguna">Pengguna</a></li>
                </ul>  
            </div>
            
            <div class="toggle" >
                <?php if(isset($_SESSION["login"])):?>
                <a onclick="show_hide()">
                    <div class="fotoprofile"><img src="profile/<?= $rowuser["foto"] ;?>"></div>
                </a>  
                <?php else :?>
                <a href="login">MASUK</a>
                <?php endif;?>   
            </div>                 
        </div>
    </header>
    <header class="move">
        <div class="container">
            <div class="head " >
                <a href="index">
                    <img src="img/logobiru.png" class="default">
                </a>    
                <ul>
                    <li><a href="">Beranda</a></li>
                    <li><a href="result">Destinasi</a></li>
                    <li><a href="pengguna">Pengguna</a></li>
                </ul>  
            </div>
            <div class="search">
                        <form action="" method="POST" >
                <input  type="text" name="lokasi" placeholder="Kota..." autocomplete="off"  >               
                <button name="cari" ><i class="fas fa-search-location fa-2x"></i></button>
            </form>
            <div class="toggle" >
                <?php if(isset($_SESSION["login"])):?>
                <a onclick="show_hide()">
                    <div class="fotoprofile"><img src="profile/<?= $rowuser["foto"] ;?>"></div>
                </a>  
                <?php else :?>
                <a href="login">MASUK</a>
                <?php endif;?>   
            </div>               
            </div>
        </div>
    </header>
    <div id="profile">
        <div class="imguser"><img src="profile/<?= $rowuser["foto"] ;?>"></div>
        <h2><?=$rowuser["username"]?></h2>
        <h5><?=$rowuser["email"]?></h5>
        <ul>
            <a href="myprofile"><li><i class="far fa-fw fa-user"></i> Profile Saya</li></a>
            <a href="logout"><li><i class="fas fa-fw fa-sign-out-alt"></i> Keluar</li></a>
        </ul>
    </div>
    <div class="searchbox">    
        <h1>LOKASI ANDA?</h1>
        <form action="" method="POST" >
            <input  type="text" name="lokasi" placeholder="kota..." autocomplete="off"  >               
            <button name="cari" ><i class="fas fa-search-location fa-2x"></i></button>
        </form>
    </div>
    <div class="intro1">
        <div class="map">
            <img src="img/destinasis.png" alt="">
        </div>
        <div class="textinfo">
            <h1>BERBAGAI MACAM DESTINASI WISATA</h1>

        </div>
    </div>
    <div class="intro2">
        <div class="textinfo">
            <h1>DIMANA KEMANAPUN</h1>
            <h1>TEMUKAN DESTINASI DISEKITARMU</h1>
        </div>
        <div class="map">
            <img src="img/maplokasi.png" alt="">
        </div>
    </div>
    <div class="intro3">
        <div class="map">
            <img src="img/fotouser.png" alt="">
        </div>
        <div class="textinfo">
            <h1>BAGIKAN FOTOMU TUNJUKAN KESERUANNYA</h1>

        </div>
    </div>

    <footer>
        <a>Jalan-jalan @Copyright 2020</a>
    </footer>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
</html>
