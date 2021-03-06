<nav>
    <div class="side" onclick="sidebar()">
        <i class="fas fa-bars fa-lg "></i>
    </div>
    <div class="toggle" >
        <a onclick="show_hide()">
            <h4><?=$user;?></h4>
            <div class="fotoprofile"><img src="profile/<?= $rowuser["foto"] ;?>"></div>
        </a>               
    </div>
</nav>

<div class="infobox">
    <div class="userbox">
        <div class="box">
            <i class="fas fa-fw fa-users fa-4x"></i>
            <h3>Pengguna Terdaftar : <?=$jumlahuser?></h3>
        </div>
    </div>
    <div class="fotobox">
        <div class="box">
            <i class="fas fa-fw fa-camera-retro  fa-4x"></i>
            <h3>Foto Diunggah : <?=$jumlahfoto?></h3>
        </div>
    </div>
</div>

<div class="newuser">
    <h2>Pengguna Baru</h2>
    <div class="userbaru">
        <?php foreach($userdatanew as $datanew):?>
        <a href="">
            <div class="pengguna">
                <div class="profileusernew">
                    <img src="profile/<?=$datanew['foto']?>" >
                </div>
                <div class="infousernew">
                    <h3><?=$datanew['username']?></h3>
                    <h5><?=$datanew['email']?></h5>
                </div>
            </div>
        </a>
        <?php endforeach;?>
    </div>
</div>