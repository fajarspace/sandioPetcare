<style>
  div.wrapper div.core div.main-product div.card:hover div.card-body p.card-text {
    color: <?= $this->config->item('default_color'); ?>;
  }

</style>
<div class="wrapper">
    <div class="title-head">
        <?php if($titleHead == ""){ ?>
            <h2 class="title">Kategori <?= $nameCat ?></h2>
        <?php }else{ ?>
            <h2 class="title">Kategori <?= $nameCat ?> > <?= $titleHead ?></h2>
        <?php } ?>
    </div>
    <div class="core">
        <div class="filter">
            <div class="filter-main">
                <div class="top">
                    <p>Filter</p>
                </div>
                <div class="bodf">
                    <p class="title">
                        Urutkan
                    </p>
                    <a href="<?= base_url(); ?>c/<?= $slug ?>?ob=latest">Terbaru</a>
                    <a href="<?= base_url(); ?>c/<?= $slug ?>?ob=az">A-Z</a>
                    <a href="<?= base_url(); ?>c/<?= $slug ?>?ob=za">Z-A</a>
                    <a href="<?= base_url(); ?>c/<?= $slug ?>?ob=pmin">Harga Terendah</a>
                    <a href="<?= base_url(); ?>c/<?= $slug ?>?ob=pmax">Harga Tertinggi</a>
                    <hr>
                    <p class="title">
                        Harga
                    </p>
                    <small class="text-muted">Tulis tanpa tanda pemisah, cth: 34000</small>
                    <form action="<?= base_url(); ?>c/<?= $slug ?>" method="get">
                        <input type="number" placeholder="Harga Minimum" name="minprice" class="form-control">
                        <input type="number" placeholder="Harga Maksimum" name="maxprice" class="form-control mt-2">
                        <button type="submit" class="btn rounded-pill btn-secondary btn-block btn-sm mt-2">Terapkan</button>
                    </form>
                    <hr>
                    <p class="title">
                        Penawaran
                    </p>
                    <a href="<?= base_url(); ?>c/<?= $slug ?>?promo=true">Promo</a>
                    <hr>
                    <p class="title">
                        Kondisi
                    </p>
                    <a href="<?= base_url(); ?>c/<?= $slug ?>?condition=1">Baru</a>
                    <a href="<?= base_url(); ?>c/<?= $slug ?>?condition=2">Bekas</a>
                    <hr>
                    <a href="<?= base_url(); ?>c/<?= $slug ?>" class="btn rounded-pill btn-danger text-light btn-sm">Reset Filter</a>
                </div>
            </div>
        </div>
        <?php $setting = $this->db->get('settings')->row_array(); ?>
        <div class="main-product">
            <?php if($products->num_rows() > 0){ ?>
            <?php foreach($products->result_array() as $p): ?>
                <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>">
                <div class="card">
                    <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" class="card-img-top" >
                    <div class="card-body">
                    <?php if($setting['promo'] == 1){ ?>
                    <?php if($p['promo_price'] == 0){ ?>
                        <p class="card-text mb-0" style="-webkit-line-clamp: 3;"><?= $p['title']; ?></p>
                        <p class="newPrice" style="color: <?= $this->config->item('default_color'); ?>">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                    <?php }else{ ?>
                        <p class="card-text mb-0"><?= $p['title']; ?></p>
                        <p class="oldPrice mb-0">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                        <p class="newPrice" style="color: <?= $this->config->item('default_color'); ?>">Rp <?= str_replace(",",".",number_format($p['promo_price'])); ?></p>
                    <?php } ?>
                    <?php }else{ ?>
                        <p class="card-text mb-0" style="-webkit-line-clamp: 3;"><?= $p['title']; ?></p>
                        <p class="newPrice" style="color: <?= $this->config->item('default_color'); ?>">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                    <?php } ?>
                    </div>
                </div>
                </a>
            <?php endforeach; ?>
            <div class="clearfix"></div>
            <?php }else{ ?>
                <div class="alert alert-warning">Upss. Tidak ada produk yang dapat ditampilkan</div>
            <?php } ?>
        </div>
    </div>
</div>