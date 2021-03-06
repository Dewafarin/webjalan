

<?php
session_start();
include 'function.php';

if(isset($_SESSION["admin"])){
    $email=$_SESSION["email"];
    $userdata=mysqli_query($conn,"SELECT * FROM tb_user WHERE email='$email'");
    $rowuser=mysqli_fetch_assoc($userdata);
    $user=$rowuser["username"];
}

$namadestinasi=$_GET["nama"];
$datadestinasi= query("SELECT * FROM destinasi WHERE nama='$namadestinasi'")[0];

if(isset($_POST["ubahdestinasi"])){
    if(ubahdestinasi($_POST)>0){
        echo "<script>alert('berhasil');
        document.location.href='admin?page=destinasi';</script>";
     
    }else{
        echo "<script>alert('gagal');
        document.location.href='editdestinasi?nama=$namadestinasi';</script>";
    }
    
}

if(isset($_POST["kembali"])){
    header("Location:admin?page=destinasi");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleeditdestinasi.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
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

    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarlama" value="<?=$datadestinasi['gambar']?>">
            <input type="hidden" name="id" value="<?=$datadestinasi['id']?>">
            <h1><?=$datadestinasi['nama']?><h1>
            <div class="allinput">
                <div class="content1">
                    <div class="input">
                        <div class="label"><i class="fas fa-fw fa-umbrella-beach"></i></div><input type="text" name="nama" placeholder="Nama..." value="<?=$datadestinasi['nama']?>"> 
                    </div>
                    <div class="input">
                        <div class="label"><i class="fas fa-fw fa-map-marker-alt"></i></div><input type="text" name="lokasi" placeholder="Kota..." value="<?=$datadestinasi['lokasi']?>"> 
                    </div>
                    <div class="input">
                        <div class="label"><i class="fas fa-fw fa-map-marked-alt"></i></div><input type="text" name="lokasifull" placeholder="Alamat..." value="<?=$datadestinasi['lokasifull']?>""> 
                    </div>
                    <div class="input">
                        <div class="label"><i class="fas fa-fw fa-link"></i></div><input type="text"  name="link" placeholder="Link Google Map..." value="<?=$datadestinasi['lokasilink']?>"> 
                    </div>
                    <div class="input">
                        <div class="label"><i class="fas fa-fw fa-ticket-alt"></i></div><input type="text" name="ket" placeholder="Tiket..." value="<?=$datadestinasi['ket']?>"> 
                    </div>
                    <div class="input">
                        <div class="label"><i class="fas fa-fw fa-hashtag"></i></div><input type="text" name="hastag" placeholder="Hastag..." value="<?=$datadestinasi['hastag']?>"> 
                    </div>
                </div>
                <div class="content2">
                    <label for="file-upload" class="custom-file-upload">
                        <i class="fas fa-image"></i> PILIH FOTO
                    </label>
                    <input type="file" name="gambar" id="file-upload" onchange="previewImage();">
                    <div class="bungkusimg" ">
                        <img id="image-preview" src="img/<?=$datadestinasi['gambar']?>">
                    </div>
                </div>
            </div>    
            <div class="textinput">
                <div class="label"><i class="fas fa-fw fa-align-justify"></i></i></div>
                <textarea name="deskripsi" placeholder="Keterangan..."><?=$datadestinasi['deskripsi']?></textarea>
            </div>
            <button name="ubahdestinasi" class="ok">Ubah</button>
            <button class="no" name="kembali">Batal</button>
        </form>
    </div>
    
    
</body>
</html>