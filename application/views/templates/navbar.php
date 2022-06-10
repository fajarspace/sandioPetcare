<?php
$settingss = $this->db->get('settings')->row_array();
?>
<header>
    <nav>
        <ul class="nav-container">
            <li class="logo">
                <a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/logo/<?= $settingss['logo']; ?>" alt="logo" width="100"></a>

            </li>
            <li class="nav-formsearch">
                <form action="<?= base_url(); ?>search" method="get">
                    <input type="text" name="q" placeholder="Cari...">
                    <button type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </li>
            <li class="nav-kategori">
                <div>
                    <h2>Semua kategori</h2>
                    <i class="fa-solid fa-angle-down"></i>
                </div>
            </li>
            <li class="nav-keranjang">
                <a href="<?= base_url(); ?>cart">
                    <div>
                    <?php if($this->cart->total_items() > 0){ ?>
                    <?= count($this->cart->contents()); ?>
                    <?php }else{ ?>
                        0
                    <?php } ?>
                </div>
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </li>
            <li>
                <div id=theme>
                    <div onclick=setDarkMode(true) id=darkBtn>
                        <i class="fa-solid fa-moon"></i>
                    </div>
                    <div onclick=setDarkMode(false) id=lightBtn class=is-hidden>
                        <i class="fa-solid fa-sun"></i>
                    </div>
                </div>
            </li>
            <li class="nav-hamburger">
                <i class="fa-solid fa-bars"></i>
                <i class="fa-solid fa-xmark"></i>
            </li>
        </ul>
    </nav>
    <?php $categories = $this->Categories_model->getCategories(); ?>
    <div class="list-kategori">
        <ul>
            <?php foreach($categories->result_array() as $cat): ?>
              <a href="<?= base_url(); ?>c/<?= $cat['slug']; ?>"><?= $cat['name']; ?></a>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="list-kategori-mobile">
        <ul>
            <?php foreach($categories->result_array() as $cat): ?>
              <a href="<?= base_url(); ?>c/<?= $cat['slug']; ?>"><?= $cat['name']; ?></a>
            <?php endforeach; ?>
        </ul>
    </div>
</header>
