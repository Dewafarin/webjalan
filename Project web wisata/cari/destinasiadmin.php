<?php

include '../function.php';
$lokasi = $_GET["keyword"];

$query=    $query ="SELECT * FROM destinasi WHERE lokasi LIKE '%$lokasi%'";

$alldestinasi = query($query);

?>



    <?php foreach($alldestinasi as $fdestinasi):?>
    <div class="destinasi">
        <div class="datadestinasi">
            <div class="bungkusimg">
                <img src="img/<?=$fdestinasi['gambar'];?>">
            </div>
            <div class="desc">
                <h1><?=$fdestinasi['nama'];?></h1>
                <h3><i class="fas fa-map-marker-alt"></i> <?=$fdestinasi['lokasi'];?></h3>
            </div>
        </div>
        <div class="action">
            <a class="ubah" href="editdestinasi?nama=<?=$fdestinasi['nama'];?>"><i class="fas fa-edit fa-2x"></i></a>
            <a  class="hapus" href="hapusdestinasi?id=<?=$fdestinasi['id']?>" onclick="return confirm('Hapus <?=$fdestinasi['nama'];?>?')"><i class="fas fa-trash fa-2x"></i></a>
        </div>
    </div>
    <?php endforeach;?>
