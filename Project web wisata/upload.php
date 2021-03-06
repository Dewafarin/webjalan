<?php
	session_start();
	// Include database connectivity
	
	include_once('function.php');
	$email=$_SESSION['email'];
	// upload file using move_uploaded_file function in php
	
	if (!empty($_FILES['image']['name'])) {

	    $fileName = $_FILES['image']['name'];
		
	    $fileExt = explode('.', $fileName);
	    $fileActExt = strtolower(end($fileExt));
	    $allowImg = array('png','jpeg','jpg');
	    $fileNew = uniqid() . "." . $fileActExt;  // rand function create the rand number 
	    $filePath = 'profile/'.$fileNew; 

	if (in_array($fileActExt, $allowImg)) {
	    if ($_FILES['image']['size'] > 0  && $_FILES['image']['error']==0) {
		$query = "  UPDATE tb_user SET foto='$fileNew' WHERE email='$email'";
	        if (mysqli_query($conn,$query)) {
			move_uploaded_file($_FILES['image']['tmp_name'], $filePath);
				$query2="UPDATE fotoupload SET fotoprofile = '$fileNew' WHERE emailfoto='$email'";
				mysqli_query($conn,$query2);
	        }else{
				echo "<script>alert('gagal kefile');
				
				</script>";
			}	
			
	      }else{
			echo "<script>alert('gagal query');
       
			</script>";
	    }
	}else{	
		echo "<script>alert('gagal array');
       
		</script>";
	}
    }

?>

<!-- UPDATE tb_user,fotoupload SET tb_user.foto='$fileNew',fotoupload.fotoprofile='$fileNew' WHERE fotoupload.emailfoto=tb_user.email AND tb_user.email='$email' -->