<!-- Modal More Category -->
<div class="modal fade" id="modalMoreCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">KATEGORI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="main-category">
          <?php foreach($categories->result_array() as $c): ?>
            <a href="<?= base_url(); ?>c/<?= $c['slug']; ?>">
              <div class="item">
                  <img src="<?= base_url(); ?>assets/images/icon/<?= $c['icon']; ?>">
                  <p><?= $c['name']; ?></p>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

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
    <div class="link"><a href="<?= base_url(); ?>products">Lihat semua..</a></div>
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