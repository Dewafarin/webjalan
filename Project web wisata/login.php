<?php
session_start();
include 'function.php';
if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["pass"];

    $user=mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
    
    if(mysqli_num_rows($user) === 1){
        $data = mysqli_fetch_assoc($user);
        
        if($password==$data["password"]){
            if(password_verify($password,$data["password"])){
           
                if($data["level"]=="admin"){
                    $_SESSION["admin"]=true;
                    $_SESSION["email"]=$email;
                   
                    header("location:admin");
                    exit;
                }else{
                    $_SESSION["login"]=true;
                    $_SESSION["email"]=$email;
                   
                    header("location:index");
                    exit;
                }
           }else{
                if($data["level"]=="admin"){
                    $_SESSION["admin"]=true;
                    $_SESSION["email"]=$email;
                   
                    header("location:admin");
                    exit;
                }else{
                    $_SESSION["login"]=true;
                    $_SESSION["email"]=$email;
                   
                    header("location:index");
                    exit;
                }
            }
        }
    $error  = true;
}else{
    $daftar = true;
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
    <div class="boxlogin">

        <div class="login">
                <form method="POST">
            <img src="img/logobiru.png">
            <h2>MASUK</h2>
    <?php if(isset($error)):?>
    <h3>kata sandi salah!!</h3>
<?php endif ;?>
<?php if(isset($daftar)):?>
    <h3>email tidak terdaftar!!</h3>
<?php endif ;?>
<div class="inputlogin">
<label for="email">Email : </label><br>
            <input type="text" name="email" id="email" <?php if(isset($error)):?>value="<?= $email;?>"<?php endif ;?>required><br>
            <label for="password">Kata Sandi : </label><br>
            <input type="password" name="pass" id="password"><br>
            <input type="submit" name="login" value="Masuk"><br>
</div>

             <div class="link1">
             <a class="repas" href="resetpass.html">Lupa Kata Sandi??</a>
                    
             </div>
             <div class="link2">
             belum punya akun? <a class="reg" href="register">daftar  </a>
             </div>
             
   
            
        </form>
        </div>

    </div>
    <script>
        (function() {
    // Add event listener
    document.addEventListener("mousemove", parallax);
    const elem = document.querySelector("body");
    // Magic happens here
    function parallax(e) {
        let _w = window.innerWidth/4;
        let _h = window.innerHeight/4;
        let _mouseX = e.clientX;
        let _mouseY = e.clientY;
        let _depth1 = `${50 - (_mouseX - _w) * 0.001}% ${50 - (_mouseY - _h) * 0.001}%`;
        let _depth2 = `${50 - (_mouseX - _w) * 0.002}% ${50 - (_mouseY - _h) * 0.002}%`;
        let _depth3 = `${50 - (_mouseX - _w) * 0.006}% ${50 - (_mouseY - _h) * 0.006}%`;
        let x = `${_depth3}, ${_depth2}, ${_depth1}`;
        console.log(x);
        elem.style.backgroundPosition = x;
    }

})();
    </script>
</body>
</html>