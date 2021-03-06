<?php
session_start();

require "function.php";
$user="";
$nama=$_GET['nama'];
$data = query("SELECT * FROM destinasi WHERE nama='$nama'")[0];
$hastag= $data['hastag'];
$datafoto = query("SELECT * FROM fotoupload WHERE hastag='$hastag'");
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
    <title>PHP</title>
    <link rel="stylesheet" href="styledestinasii.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="script.js"></script>
</head>
<body>
<div id="uploadback"></div>
<header class="default">
        <div class="container">
            <div class="head" >
                <a href="index">
                    <img src="img/logoputih.png" class="default">
                </a>  
                <ul>
                    <li><a href="index">Beranda</a></li>
                    <li><a href="result">Destinasi</a></li>
                    <li><a href="pengguna">Pengguna</a></li>
                </ul>  
            </div>
 
            <div class="search">
                        <form action="" method="POST" >
                <input  type="text" name="lokasi" placeholder="Kota..." autocomplete="off"  class="default" >               
                <button name="cari" class="default"><i class="fas fa-search-location fa-2x" ></i></button>
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
        </div>
    </header>
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
<div class="destinasi">
    
  
    <div class="img" style="background-image: url('<?= "img/$data[gambar]"; ?>');"></div>
   
    <h1 ><?= $data["nama"]?></h1>

   <div class="isi">

    <ul>
        <li class="lokasi"><a href="<?= $data["lokasilink"]?>" target="_blank"><img src="img/lokasi.png"><?= $data["lokasifull"]?></a></li>
        <li class="ket"><img src="img/tiket.png"><?= $data["ket"]?></li>
    </ul>
    <p>
        <?= $data["deskripsi"]?>
    </p>
    </div>
</div>
<div class="fotousersemua">
    <h1>#<?= $data["hastag"]?></h1>
</div>


<?php 
        $i=1;
    ?>
    <div class="containerfoto">
    <?php foreach($datafoto as $fotouser) : ?>

        <div class="fotouser"  onclick="openpreview();currentslide(<?=$i;?>)">
            
           
                
                <img src="fotoupload/<?= $fotouser["foto"]; ?>">
                  <div class="overlay"></div>
   
        </div>


    <?php 
        $i++;
    ?>
    <?php endforeach;?>   
    </div>

    <div id="preview">
  
            <div class="closebutton">
                <a onclick="closepreview()">&#x2716;</a>
            </div>
            <?php $j=1;?>
            <?php foreach($datafoto as $fotouser) : ?>
    
            <div class="fotopre">
            <div class="bungkuspreview">
                <div class="infofoto">
                    <?php if($fotouser['username']==$user):?>
                    <a href="myprofile">
                    <?php else :?>
                        <a href="view?nama=<?=$fotouser['username']?>">
                    <?php endif;?>
                
                    <div class="fotopupload">
                        <img src="profile/<?= $fotouser["fotoprofile"]; ?>"> 
                        <?= $fotouser["username"];?>
                    </div>
                    </a>
                   
                </div>
                <div class="fotonya">
                    <img src="fotoupload/<?= $fotouser["foto"]; ?>"> 
                </div> 
            </div>   
            </div>
            <?php $j++;?>
            <?php endforeach;?> 
            <a id="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a id="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <footer>
        <a>Jalan-jalan @Copyright 2020</a>
    </footer>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
    
    $(window).scroll(function(){
    var hScroll=$(this).scrollTop();


    
    
    if(hScroll< 100){
        $('header.move').css({
            'opacity':'0',
            'transform': 'translate(0, -70px)'
        });
        $('header.default').css({
            'opacity':'1',
            'z-index':'3'
        });
    }


    

    if(hScroll> 100){
        $('header.default').css({
            'opacity':'0',
            'z-index':'3'
        });
        $('header.move').css({
            'opacity':'1',
            'z-index':'3',
            'transform': 'translate(0, 0)'
        });

    }
    
    $('.destinasi h1').css({
            'transform':'translate(0px,'+ hScroll/6.2 +'%)'
        });

});

    </script>
</body>
</html>