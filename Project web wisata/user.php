<?php
session_start();
if(!isset($_SESSION["login"])){
    header("location:login");
    exit;
}

$email=$_SESSION["email"];
include "function.php";

if(isset($_POST["cari"])){
     $lokasi=($_POST["lokasi"]); 
    if(empty(trim($lokasi))){
        false;
    }else{
        header("Location:result?lokasi=$lokasi");
    }
    
    
}
$userdata=mysqli_query($conn,"SELECT * FROM tb_user WHERE email='$email'");
$data=mysqli_fetch_assoc($userdata);
$user=$data["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalan jalan</title>
    <link rel="stylesheet" type="text/css" href="styleuser.css">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    
</head>
<body>  
    <header>
        <div class="container">
            <div class="head">
            <?php if(isset($_SESSION["login"])):?>
  
  <a href="user">
         <img src="img/logo.png" >
     </a>    
<?php else :?>
<a href="index">
         <img src="img/logo.png" >
     </a>    
<?php endif;?>             
            </div>
            <div class="search">
                        <form action="" method="POST" >
                <input  type="text" name="lokasi" placeholder="Kota..." autocomplete="off"  >               
                <button name="cari" ><i class="fas fa-search-location fa-2x"></i></button>
            </form>

                <div class="toggle" >
                    <a onclick="show_hide()"><div class="fotoprofile"><img src="profile/<?= $data["foto"] ;?>"></div>
                  
                    
                    </a>
                    
                </div>
  
            </div>
            
        </div>

    </header>
    <div id="profile">
    <div class="fotoprofileuser" >
                    <a><div class="fotoprofile"><img src="profile/<?= $data["foto"] ;?>"></div>
                  
                    
                    </a>
                    
                </div>
        <h2><?php echo $user;?></h2><hr>
        <ul>
            <li ><a href="myprofile?user=<?= $user?>" class="profile"><i class="fas fa-user-alt"></i> Profil Saya</a></li>
            <li ><a href="logout" class="out">Keluar <i class="fas fa-sign-out-alt"></i></a></li>

        </ul>
        </div>
    <section id="main">
        
      
            <h1>DIMANA KEMANAPUN</h1><br>
            <h5>Temukan Destinasi Anda</h5>
     
    </section>
    <footer>
        <a>Jalan-jalan @Copyright 2020</a>
    </footer>

    <script src="script.js"></script>
</body>
</html>
</html>
