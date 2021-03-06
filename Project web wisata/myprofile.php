<?php
session_start();
if(!isset($_SESSION["login"])){
    header("location:login");
    exit;
}
include "function.php";


if(isset($_POST["cari"])){
    $lokasi=($_POST["lokasi"]); 
   if(empty(trim($lokasi))){
       false;
   }else{
       header("Location:result?lokasi=$lokasi");
   }  
}

if(isset($_POST["confirmbio"])){
    editbio($_POST);
    $url = $_SERVER['REQUEST_URI'];   
    header("Location:$url");     

}

if(isset($_POST["upload"])){
    if(uploadfoto($_POST)>0){
        echo "<script>alert('Foto Diupload');</script>";
        $url = $_SERVER['REQUEST_URI'];  
  
        header("Location:$url");  
    }else{
        echo "<script>alert('Foto Gagal Diupload');</script>";
    }
    
}

if(isset($_SESSION["login"])){
    $email=$_SESSION["email"];
    $userdata=mysqli_query($conn,"SELECT * FROM tb_user WHERE email='$email'");
    $rowuser=mysqli_fetch_assoc($userdata);
    $user=$rowuser["username"];
}





    $email=$_SESSION["email"];
    $datafoto=query("SELECT * FROM fotoupload WHERE emailfoto ='$email' ORDER BY id DESC ");
    $userweb=query("SELECT * FROM tb_user WHERE email='$email'");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylemyprofile.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">

    <script type="text/javascript" src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div id="uploadback"></div>
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
    <div class="profileuser">
    <?php foreach($userweb as $data) : ?>
        <div class="foto">
            <img src="profile/<?= $data["foto"];?>">        
            <form method="post" enctype="multipart/form-data" id="submitForm">
                <input type="file" name="image" class="custom-file-input" id="image"> 
            </form>
        </div>
        
        <div class="nama">
            <h1><?= $data["username"];?></h1>
        </div>
        <div class="bio">
            <div id="bionow">
                <span>
                    <?= $data["bio"];?>
                </span>
                <a onclick="editbio()"><i class="fas fa-edit "></i></a> 
            </div>
            <div id="editbio">
                <form method="post" > 
                    <input type="hidden" name="id" value="<?= $data["id"]?>">
                    <textarea name="newbio"   placeholder="Bio"><?= $data["bio"];?></textarea>
                    <button name="confirmbio" >Ubah</button>            
                </form>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <div class="button">
            <button onclick="upload()" >BAGIKAN FOTOMU +</buttons>
    </div>
    
    <div id="upload">
 
        <div class="uploadgambar">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="fotop" value="<?= $rowuser["foto"] ?>">
                <input type="hidden" name="username" value="<?= $user?>">
                <input type="hidden" name="email" value="<?php echo $email?>">
                <div class="closebutton">
                    <a onclick="upload()" href="">&#x2716;</a>
                </div>
                <label for="file-upload" class="custom-file-upload">
                    <i class="fas fa-upload"></i> PILIH FOTO
                </label>
                <input type="file" name="foto" id="file-upload" onchange="previewImage();">
                <div class="bungkusimg"><img id="image-preview" alt="image preview" ></div>
                <div class="bungkusbutton">
                    <label for="#upload">#</label>
                    <input type="text" id="#upload" name="hastag">
                    <button name="upload">BAGIKAN</button>
                </div>
            </from>
        </div>
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
                    <a href="myprofile">
                    <div class="fotopupload">
                        <img src="profile/<?= $fotouser["fotoprofile"]; ?>"> 
                        <?= $fotouser["username"];?>
                    </div>
                    </a>
                    <div class="menu">
                        <a href="hapusfotoprofile?id=<?=$fotouser['id']?>" onclick="return confirm('Hapus foto?')"><i class="far fa-fw fa-trash-alt "></i></a>
                    </div>
                   
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
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
   $("#submitForm").on("change", function(){
      var formData = new FormData(this);
      $.ajax({
         url  : "upload.php",
         type : "POST",
         cache: false,
         contentType : false, // you can also use multipart/form-data replace of false
         processData: false,
         data: formData,
         success:function(response){
       
     
          document.location.reload(true);
         }
      });
   });
});
</script>
