<?php if($best->num_rows() > 0){ ?>
<main class="container">
  <div class="header-produk" ><h1 >PRODUK TERLARIS</h1></div>
  <div class="produk-list">
  <?php foreach($best->result_array() as $p): ?>
    <div class="produk-box">
        <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>">
          <div>
          <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" >
            
            <div class="ket">
              <h2><?= $p['title']; ?></h2>
              <h3>Rp <?= str_replace(",",".",number_format($p['price'])); ?></h3>
            </div>
            </div>
        </a>
    </div>
  <?php endforeach; ?>
  <div class="clearfix"></div>
  </div>
</main>
<?php } ?>

<?php if($recent->num_rows() > 0){ ?>
<main class="container">
  <div style="display:flex; justify-content: space-between;" >
    <div class="header-produk"><h1>PRODUK TERBARU</h1></div>
    <div class="link" ><a style="color: grey" href="<?= base_url(); ?>products">Lihat semua..</a></div>
  </div>
  <div class="produk-list">
  <?php foreach($recent->result_array() as $p): ?>
    <div class="produk-box">
        <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>">
          <div>
          <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" >
            
            <div class="ket">
              <h2><?= $p['title']; ?></h2>
              <h3>Rp <?= str_replace(",",".",number_format($p['price'])); ?></h3>
            </div>
            </div>
        </a>
    </div>
  <?php endforeach; ?>
  <div class="clearfix"></div>
  </div>
</main>
<?php } ?>