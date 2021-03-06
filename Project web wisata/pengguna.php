<?php
session_start();
include 'function.php';

$user="";



if(isset($_POST["cari"])){
    $lokasi=($_POST["lokasi"]); 
   if(empty(trim($lokasi))){
        false;
   }else{
       header("Location:result?lokasi=$lokasi");
   }  
}

if(isset($_POST["cariuser"])){
    $pengguna=($_POST["pengguna"]); 
   if(empty(trim($pengguna))){
        false;
   }else{
       header("Location:?key=$pengguna");
   }  
}

if(isset($_GET["key"])){
    $key = $_GET["key"];
    $penggunacari=query("SELECT * FROM tb_user WHERE username LIKE'$key%'");
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
    <title>Document</title>
    <link rel="stylesheet" href="pengguna.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="script.js"></script>
</head>
<body>
    <header class="move">
        <div class="container">
            <div class="head " >
                <a href="index">
                    <img src="img/logobiru.png" class="default">
                </a>    
                <ul>
                    <li><a href="index">Beranda</a></li>
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
            <form action="" method="POST" class="cariuser">
                <input  type="text" name="pengguna" placeholder="Nama..." autocomplete="off"  ">               
                <button name="cariuser" ><i class="fas fa-search fa-2x"></i></button>
            </form>
            <div id="alluser">
                <div class="userf">
                <?php if(!isset($penggunacari)) :?>
                    <div class="kosong">- temukan seseorang -</div>
                <?php else :?>
       
                <?php foreach($penggunacari as $alldata):?>
                <div class="alldatauser">
                    <?php if($alldata['username']==$user):?>
                    <a class="bungkus" href="myprofile">
                    <?php else :?>
                        <a class="bungkus" href="view?nama=<?=$alldata['username']?>">
                    <?php endif;?>
                        <div class="pengguna">
                            <div class="profileuser">
                                <img src="profile/<?=$alldata['foto']?>" >
                            </div>
                            <div class="infouser">
                                <h3><?=$alldata['username']?></h3> <h5 class="level"><?=$alldata['level'];?></h5>
                                <h5><?=$alldata['email']?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach;?>
                <?php endif;?>
                </div>
            </div>
        </div>

<footer>
        <a>Jalan-jalan @Copyright 2020</a>
    </footer>

        
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>


    </script>
</body>
</html>