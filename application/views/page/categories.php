

<?php $setting = $this->db->get('settings')->row_array(); ?>
<main class="container">
<div class="header-produk" ><h1>kategori</h1></div>
<div class="produk-list">
    <?php if($products->num_rows() > 0){ ?>
        <?php foreach($products->result_array() as $p): ?>
    <div class="produk-box">
        <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>">
        <div>
          <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" > 
            <div class="ket">
              <h2 ><?= $p['title']; ?></h2>
              <h3>Rp <?= str_replace(",",".",number_format($p['price'])); ?></h3>
                
            </div>
        </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<div class="clearfix"></div>
<?php }else{ ?>
    <div class="alert alert-warning">Upss. Tidak ada produk yang dapat ditampilkan</div>
<?php } ?>
</main>
            