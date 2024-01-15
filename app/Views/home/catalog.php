<?=$this->extend('home/home');?>

<?=$this->section('content');?>

<div class="banner">
  <img src="Asset\liveit\catalog\banner.jpg" alt="" class="banner-catalog">
</div>

<div class="head-commerce shadow">
  <div class="bor">
    <h1>Live Toko Online</h1>
  </div>
</div>

<div class="cont">

<?php foreach ($catalog as $c): ?>
<div class="cat shadow">

  <div class="row">
    <div class="foto col-md-4">
    <div class="col-md-12 co-sm-4">
          <img src="/Asset/liveit/catalog/gambar/<?= $c['gambar'];?>" class="img-fluid rounded-start img-gedung" alt="...">
          </div>
    </div>
    <div class="desk col-md-7">
    <div class="col-md-8 co-sm-4 ps-1">
              <h5 class="card-title"></h5>
              <p class="card-text nomor-ruangan"><?= $c['nomor_ruangan'];?></p>
              <h2 class="rating-star"><i class="fa-solid fa-star fa-2xs"></i><i class="fa-solid fa-star fa-2xs"></i><i class="fa-solid fa-star fa-2xs"></i><i class="fa-solid fa-star fa-2xs"></i><i class="fa-solid fa-star fa-2xs"></i></h2>
              <p class="card-text tipe"><?= $c['tipe'];?></p>
              <div class="desk-pass">
              <p class="card-text deskripsi"><?= $c['deskripsicom'];?></p>
              </div>
              <a href="<?= base_url('/user/sewa'); ?>" class="btn-success pesan"><i class="fa-solid fa-cart-shopping"></i> Pesan</a>      
          </div>
    </div>

  </div>
 
</div>
<?php endforeach; ?>


</div>


<?=$this->endSection('content');?>
