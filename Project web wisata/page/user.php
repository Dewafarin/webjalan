<nav>
    <div class="side" onclick="sidebar()">
        <i class="fas fa-bars fa-lg "></i>
    </div>
    <div class="cariloc">
        <form method="post">
            <input  type="text" name="namauser" placeholder="Nama pengguna..." autocomplete="off"  id="user">               

        </form>
    </div>
    <div class="toggle" >
        <a onclick="show_hide()">
            <h4><?=$user;?></h4>
            <div class="fotoprofile"><img src="profile/<?= $rowuser["foto"] ;?>"></div>
        </a>               
    </div>
</nav>

<div id="alluser">
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
            <a class="action" href="deleteuser?id=<?=$alldata['id']?>" onclick="return confirm('Hapus <?=$alldata['username'];?>?')">
                <div class="action">
                    <i class="fas fa-ban fa-3x"></i>
                </div>
            </a>
        </div>
        <?php endforeach;?>
    </div>
</div>

<script>
    $(document).ready(function(){
            $('#user').on('keyup',function(){
                $('#alluser').load('cari/useradmin.php?keyword=' + $('#user').val());
        });
    });
</script>