<?php
session_start();

require "function.php";

$data = query("SELECT * FROM destinasi");
$lokasiawal = "";

if(isset($_GET["lokasi"])){
    $lokasiawal = $_GET["lokasi"];
    $data = query("SELECT * FROM destinasi WHERE lokasi LIKE '$lokasiawal%'");
}






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
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="styleresult.css" text="text/css">
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
        <form action="" method="POST" >
                <input  type="text" name="lokasi" placeholder="Kota..." autocomplete="off"  value="<?=$lokasiawal?>">               
                <button name="cari" ><i class="fas fa-search-location fa-2x"></i></button>
            </form>
</div>

<div class="result">

   

<?php if($data==[]) :?>
<h1>Lokasi Tidak Ditemukan :(</h1>
<?php endif;?>
<?php foreach($data as $destinasi) : ?>
        <a href="destinasi?nama=<?= $destinasi['nama'];?> ">  
            <div class="destinasi">
   
                    <h3 class="lokasi"><?= $destinasi["lokasi"]?></h3>       
                    <img src="img/<?= $destinasi["gambar"]; ?>">
                    <h2 class="nama"><?= $destinasi["nama"]?></h2>
           
            </div>
        </a>

<?php endforeach;?>


</div>
<footer>
        <a>Jalan-jalan @Copyright 2020</a>
    </footer>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
        $(window).on('load',function(){
            $('.destinasi').each(function(i){
                setTimeout(function() {
                    $(' .destinasi').eq(i).addClass('muncul');
                }, 100 * i);
            });
        });

    </script>

</body>
</html>