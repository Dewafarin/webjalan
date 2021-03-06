

<nav>
    <div class="side" onclick="sidebar()">
        <i class="fas fa-bars fa-lg "></i>
    </div>
    <div class="cariloc">
        <form method="post">
            <input  type="text" name="carifoto" placeholder="hastag..." autocomplete="off" id="foto" >               
        </form>
    </div>
    <div class="toggle" >
        <a onclick="show_hide()">
            <h4><?=$user;?></h4>
            <div class="fotoprofile"><img src="profile/<?= $rowuser["foto"] ;?>"></div>
        </a>               
    </div>
</nav>

<div id="fotoalluser">
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
</div>

<script>
    $(document).ready(function(){
            $('#foto').on('keyup',function(){
                $('#fotoalluser').load('cari/fotoadmin.php?keyword=' + $('#foto').val());
        });
    });
</script>