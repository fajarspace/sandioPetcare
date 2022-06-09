<div class="wrapper">
    <div class="countdown mb-2">
        <p class="lead text-light"><?= $package['title'] ?></p>
    </div>
    <img src="<?= base_url(); ?>assets/images/banner/<?= $package['banner']; ?>" class="img-banner">
    <?php $setting = $this->db->get('settings')->row_array(); ?>
    <?php if($packdata->num_rows() > 0){ ?>
    <div class="main-product">
        <?php foreach($packdata->result_array() as $p): ?>
            <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>">
            <div class="card">
                <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" class="card-img-top" >
                <div class="card-body">
                <?php if($setting['promo'] == 1){ ?>
                <?php if($p['promo_price'] == 0){ ?>
                    <p class="card-text mb-0" style="-webkit-line-clamp: 3;"><?= $p['title']; ?></p>
                    <p class="newPrice price-padding">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                <?php }else{ ?>
                    <p class="card-text mb-0" ><?= $p['title']; ?></p>
                    <p class="oldPrice mb-0">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                    <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['promo_price'])); ?></p>
                <?php } ?>
                <?php }else{ ?>
                    <p class="card-text mb-0" style="-webkit-line-clamp: 3;"><?= $p['title']; ?></p>
                    <p class="newPrice price-padding">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                <?php } ?>
                </div>
            </div>
            </a>
        <?php endforeach; ?>
        <div class="clearfix"></div>
    </div>
    <?php }else{ ?>
    <div class="alert alert-warning mt-4">Tidak ada produk yang tersedia untuk saat ini. Coba lagi nanti</div>
    <?php } ?>
</div>