<main class="container">
<div class="wrapper">
    <div class="title-head">
            <h2 class="title">Hasil Pencarian: <?= $q ?> <?= $titleHead ?></h2>
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
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=latest">Terbaru</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=az">A-Z</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=za">Z-A</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=pmin">Harga Terendah</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=pmax">Harga Tertinggi</a>
                    <hr>
                    <p class="title">
                        Penawaran
                    </p>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&promo=true">Promo</a>
                    <hr>
                    <p class="title">
                        Kondisi
                    </p>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&condition=1">Baru</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&condition=2">Bekas</a>
                    <hr>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>" class="btn rounded-pill btn-danger text-light btn-sm">Reset Filter</a>
                </div>
            </div>
        </div>
        <?php $setting = $this->db->get('settings')->row_array(); ?>

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

        </div>

            <div class="clearfix"></div>
            <?php }else{ ?>
                <div class="alert alert-warning">Upss. Tidak ada produk yang dapat ditampilkan</div>
            <?php } ?>
    </div>
</main>
