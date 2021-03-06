<?php

$conn = new mysqli("localhost", "root", "", "webjalan2");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);

    $semuadata= [];

    while($data = mysqli_fetch_assoc($result)){
        $semuadata[]=$data;
    }
    return $semuadata;
}

function register($data){
    global $conn;
    $newuser=$data["username"];
    $pass1=$data["pass1"];
    $pass2=$data["pass2"];
    $nohp=$data["nohp"];
    $email=$data["email"];


    $cekuser=mysqli_query($conn,"SELECT username FROM tb_user WHERE username='$newuser'");
    if(mysqli_fetch_assoc($cekuser)){
        echo "<script>alert('user telah terdaftar!!!')</script>";
        return false;
    }
    
    $cekemail=mysqli_query($conn,"SELECT email FROM tb_user WHERE email='$email'");
    if(mysqli_fetch_assoc($user)){
        echo "<script>alert('email telah terdaftar!!!')</script>";
        return false;
    }
    
    if($pass1 !== $pass2){
        echo "<script>alert('Password Berbeda!!!')</script>";
        return false;
    }
    $password= $pass1;
    // $password= password_hash($pass1,PASSWORD_DEFAULT);
    

    $query="INSERT INTO tb_user
     VALUES
     ('','$newuser','$email','$nohp','$password','vektorprofile.jpg','','user')";

     mysqli_query($conn,$query);

     return mysqli_affected_rows($conn);
}

function editbio($data){
    global $conn;
    $id=$data["id"];
    $newbio=$data["newbio"];
    
    $query="UPDATE tb_user SET bio='$newbio' WHERE id = $id";
    mysqli_query($conn,$query);
    
}

function uploadfoto($data){
    global $conn;
    $username=$data["username"];
    $email=$data["email"];
    $hastag=$data["hastag"];
    $fotoprofile=$data["fotop"];
    $foto= uploadcek();

    if(!$foto){
        return false;
    }

    $query="INSERT INTO fotoupload VALUES ('','$email','$username','$hastag','$fotoprofile','$foto')";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function uploadcek(){
    $namafile= $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

    if($error === 4){
        echo "<script>alert('Pilih Foto!!');</script>";
        return false;
    }

    $typefilevalid=['jpg','jpeg','png'];
    $namafilelengkap= explode('.',$namafile);
    $typefile = strtolower(end($namafilelengkap));

    if(!in_array($typefile,$typefilevalid)){
        echo "<script>alert('Type file harus png,jpg,jepg');</script>";
        return false;
    }

    if($ukuran>10000000){
        echo "<script>alert('Ukuran max 10MB');</script>";
        return false;
    }

    $namafileacak=uniqid() . "." . $namafile;

    move_uploaded_file($tmpname,'fotoupload/'.$namafileacak);

    return $namafileacak;
}

function caridestinasi($cari){
    $query ="SELECT * FROM destinasi WHERE lokasi='$cari'";
    return query($query);
}

function ubahdestinasi($data){
    global $conn;
    $id=$data["id"];
    $nama=$data["nama"];
    $lokasi=$data["lokasi"];
    $lokasifull=$data["lokasifull"];
    $link=$data["link"];
    $ket=$data["ket"];
    $hastag=$data["hastag"];
    $desc=$data["deskripsi"];
    $gambarlama=$data["gambarlama"];

    if($_FILES['gambar']['error'] === 4){
        $gambar=$gambarlama;

    }else{
        $gambar= gambarcek();
    }

    

    $query="UPDATE  destinasi SET nama='$nama', gambar='$gambar', lokasi='$lokasi',
            lokasifull='$lokasifull',ket='$ket', lokasilink='$link', deskripsi='$desc', hastag='$hastag' WHERE id=$id";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function gambarcek(){
    $namafile= $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    if($error === 4){
        echo "<script>alert('Pilih Foto!!');</script>";
        return false;
    }

    $typefilevalid=['jpg','jpeg','png'];
    $namafilelengkap= explode('.',$namafile);
    $typefile = strtolower(end($namafilelengkap));

    if(!in_array($typefile,$typefilevalid)){
        echo "<script>alert('Type file harus png,jpg,jepg');</script>";
        return false;
    }

    if($ukuran>10000000){
        echo "<script>alert('Ukuran max 10MB');</script>";
        return false;
    }

    $namafileacak=uniqid() . "." . $namafile;

    move_uploaded_file($tmpname,'img/'.$namafileacak);

    return $namafileacak;
}

function tambahdestinasi($data){
    global $conn;
    $nama=$data["nama"];
    $lokasi=$data["lokasi"];
    $lokasifull=$data["lokasifull"];
    $link=$data["link"];
    $ket=$data["ket"];
    $hastag=$data["hastag"];
    $desc=$data["deskripsi"];
    $gambar= gambarcek();

    if(!$gambar){
        return false;
    }

    $query="INSERT INTO destinasi VALUES ('','$gambar','$nama','$lokasi','$link','$ket','$desc','$lokasifull','$hastag')";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function hapusdes($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM destinasi WHERE id=$id");
    
}

function hapusu($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_user WHERE id=$id");
    
}

function hapusf($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM fotoupload WHERE id=$id");
    
}