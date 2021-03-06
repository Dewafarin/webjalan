<?php

include '../function.php';
$user = $_GET["keyword"];

$query=    $query ="SELECT * FROM tb_user WHERE username LIKE '%$user%'";

$alluser = query($query);

?>

    <div class="userf">
        <?php foreach($alluser as $alldata):?>
        <div class="alldatauser">
            <a class="bungkus" href="">
                <div class="pengguna">
                    <div class="profileuser">
                        <img src="profile/<?=$alldata['foto']?>" >
                    </div>
                    <div class="infouser">
                        <h3><?=$alldata['username']?></h3> <h5 class="level"><?=$alldata['level'];?></h5>
                        <h5><?=$alldata['email']?></h5>
                    </div>
                </div>
            </a>
            <a class="action" href="">
                <div class="action">
                    <i class="fas fa-ban fa-3x"></i>
                </div>
            </a>
        </div>
        <?php endforeach;?>
    </div>