<div id=""></div>
<nav>
    <div class="side" onclick="sidebar()">
        <i class="fas fa-bars fa-lg "></i>
    </div>
    <div class="cariloc">
        <form method="post">
            <input  type="text" name="caridestinasi" placeholder="Kota..." autocomplete="off"  id="lokasi">               
        </form>
    </div>
    <div class="toggle" >
        <a onclick="show_hide()">
            <h4><?=$user;?></h4>
            <div class="fotoprofile"><img src="profile/<?= $rowuser["foto"] ;?>"></div>
        </a>               
    </div>
</nav>

<div class="tambahdestinasi">
    <a href="tambahdestinasi">DESTINASI &plus;</a>
</div>

<div id="kumdestinasi">
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
            <a  class="hapus" href="hapusdestinasi?id=<?=$fdestinasi['id']?>" onclick="return confirm('Hapus <?=$fdestinasi['nama'];?>?')" ><i class="fas fa-trash fa-2x"></i></a>
        </div>
    </div>
    <?php endforeach;?>
</div>

<!-- <div id="popup">
    <i class="fas fa-exclamation-triangle fa-4x"></i>
    <div class="popuphapus">
  
        <div class="deldestinasi">
            <span>Hapus ?</span>
        </div>
        <div class="button">
            <button>Oke</button>
            <button>Cancel</button>
        </div>
        
    </div>
</div> -->

<script>
    $(document).ready(function(){
            $('#lokasi').on('keyup',function(){
                $('#kumdestinasi').load('cari/destinasiadmin.php?keyword=' + $('#lokasi').val());
        });
    });
</script>