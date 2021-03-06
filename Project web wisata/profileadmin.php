<?php
session_start();
include 'function.php';

if(isset($_SESSION["admin"])){
    $email=$_SESSION["email"];
    $userdata=mysqli_query($conn,"SELECT * FROM tb_user WHERE email='$email'");
    $rowuser=mysqli_fetch_assoc($userdata);
    $user=$rowuser["username"];
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

$datafoto=query("SELECT * FROM fotoupload WHERE emailfoto ='$email' ORDER BY id DESC ");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylepadmin.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    
    <script type="text/javascript" src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>
    <div id="uploadback"></div>
    <div id="overlay">
        <div id="sidebar">
            <div class="sidebartoggle">
                <div class="side" onclick="sidebartoggle()">
                    <i class="fas fa-bars fa-lg "></i>
                </div>
                <div class="logo">
                    <a href="admin">
                        <img src="img/logo.png">
                    </a>
                </div>
            </div><hr>
            <nav>
                <ul>
                    <a href="admin?page=beranda"><li><i class="fas fa-fw fa-home"></i> Beranda</li></a>      
                    <a href="admin?page=destinasi"><li><i class="fas fa-fw fa-umbrella-beach"></i> Destinasi</li></a>       
                    <a href="admin?page=pengguna"><li><i class="fas fa-fw fa-users"></i> Pengguna</li></a>       
                    <a href="admin?page=foto"><li><i class="fas fa-fw fa-camera-retro"></i> Foto</li></a>             
                    <a href="logout"><li><i class="fas fa-fw fa-sign-out-alt"></i> Keluar</li></a>
                </ul>      
            </nav>
        </div>
    </div>
    <header>
        <div class="side" onclick="sidebartoggle()">
            <i class="fas fa-bars fa-lg "></i>
        </div>
        <div class="toggle" >
            <a onclick="show_hide()">
                <h4><?=$user;?></h4>
                <div class="fotoprofile"><img src="profile/<?= $rowuser["foto"] ;?>"></div>
            </a>               
        </div>
    </header>

    <div id="profile">
        <ul>
            <a href="profileadmin"><li>Profile saya</li></a>
            <a href="switchacc"><li>Ganti akun</li></a>                 
        </ul>
    </div>

    <div class="profileuser">
        <div class="foto">
            <img src="profile/<?= $rowuser["foto"];?>">        
            <form method="post" enctype="multipart/form-data" id="submitform">
                <input type="file" name="image" class="custom-file-input" id="image"> 
            </form>
        </div>
        <div class="nama">
            <h1><?= $rowuser["username"];?></h1>
        </div>
        <div class="bio">
            <div id="bionow">
                <span>
                    <?= $rowuser["bio"];?>
                </span>
                <a onclick="editbio()"><i class="fas fa-edit "></i></a> 
            </div>
            <div id="editbio">
                <form method="post" > 
                    <input type="hidden" name="id" value="<?= $rowuser["id"]?>">
                    <textarea name="newbio"   placeholder="Bio"><?= $rowuser["bio"];?></textarea>
                    <button name="confirmbio" >Ubah</button>            
                </form>
            </div>
        </div>
    </div>
    <div class="button">
        <button onclick="upload()" >BAGIKAN FOTOMU +</buttons>
    </div>

    <div id="upload">
        <div class="uploadgambar">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="fotop" value="<?= $rowuser["foto"] ?>">
                <input type="hidden" name="username" value="<?= $user?>">
                <input type="hidden" name="email" value="<?=$email?>">
                <div class="closebutton">
                    <a onclick="upload()" href="">&#x2716;</a>
                </div>
                <label for="file-upload" class="custom-file-upload">
                    <i class="fa fa-cloud-upload"></i> PILIH FOTO
                </label>
                <input type="file" name="foto" id="file-upload" onchange="previewImage();">
                <div class="bungkusimg"><img id="image-preview" alt="image preview"></div>
                <div class="bungkusbutton">
                    <label for="#upload">#</label>
                    <input type="text" id="#upload" name="hastag">
                    <button name="upload">BAGIKAN</button>
                </div>
            </from>
        </div>
    </div>
        <?php $i=1;?>
    <div class="containerfoto">
        <?php foreach($datafoto as $fotouser) : ?>
        <div class="fotouser"  onclick="openpreview();currentslide(<?=$i;?>)">                                     
            <img src="fotoupload/<?= $fotouser["foto"]; ?>">
            <div class="overlay"></div>  
        </div>
        <?php $i++; ?>
        <?php endforeach;?>   
    </div>
    <div id="preview">    
        <div class="closebutton">
            <a onclick="closepreview()">&#x2716;</a>
        </div>
        <?php foreach($datafoto as $fotouser) : ?>
        <div class="fotopre">
            <img src="fotoupload/<?= $fotouser["foto"]; ?>">      
        </div>
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
   $("#submitform").on("change", function(){
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
