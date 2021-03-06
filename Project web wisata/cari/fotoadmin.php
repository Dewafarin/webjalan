<?php

include '../function.php';
$foto = $_GET["keyword"];

$query=    $query ="SELECT * FROM fotoupload WHERE hastag LIKE '%$foto%'";

$allfoto = query($query);

?>
    
    
    
    
    <?php foreach ($allfoto as $sfotouser):?>
        <div class="bungkusfoto">
        <img src="fotoupload/<?=$sfotouser['foto']?>" class="fotouser">
        <div class="infofoto">
            <div class="hapusfoto"><a href="hapusfoto?id=<?=$sfotouser['id']?>" onclick="return confirm('Hapus foto <?=$sfotouser['username'];?>?')"><i class="fas fa-times"></i></a></div>
            <img src="profile/<?=$sfotouser['fotoprofile']?>">
            <h3><?=$sfotouser['username']?></h3>
            <h5><?=$sfotouser['emailfoto']?></h5>
            <h2>#<?=$sfotouser['hastag']?></h2>
        </div>
    </div>
    <?php endforeach ;?>