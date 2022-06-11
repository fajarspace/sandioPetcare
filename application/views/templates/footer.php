<?php
$categoriesLimit = $this->Categories_model->getCategoriesLimit();
$setting = $this->Settings_model->getSetting();
$sosmed = $this->Settings_model->getSosmed();
$footerhelp = $this->Settings_model->getFooterHelp();
$footerinfo = $this->Settings_model->getFooterInfo();
$settingss = $this->db->get('settings')->row_array();
$rekening = $this->db->get('rekening');
 ?>
    <footer>
        <div class="footer-section">
            <h3>Ikuti kami :</h3>
                <?php foreach($sosmed->result_array() as $s): ?>
                  <a href="<?= $s['link']; ?>" target="_blank" title="<?= $s['name']; ?>">
                    <div><i class="fab fa-<?= $s['icon']; ?>"></i></div>
                  </a>
                <?php endforeach; ?>
        </div>
        <div class="footer-row">

            <div class="footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <?php foreach($footerhelp->result_array() as $f): ?>
                  <li><a href="<?= base_url(); ?><?= $f['slug']; ?>"><?= $f['title']; ?></a></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Pembayaran</h4>
                <ul>
                    <li><?php foreach($rekening->result_array() as $r): ?>
                  <p class="mb-0"><?= $r['rekening']; ?></p>
                <?php endforeach; ?></li>
                </ul>
            </div>
            <div class="footer-col" >
                <h4>
                    Copyright &copy; <script>document.write(new Date().getFullYear());</script> Sandio Petcare
                </h4>
            </div>

        </div>
    </footer>

    <script src="<?= base_url();  ?>assets/static/js/nav.js"></script>
    <script src="<?= base_url();  ?>assets/static/js/dark_mode.js"></script>
    <script src="<?= base_url();  ?>assets/static/js/produk.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.countdown.min.js"></script>
    <script src="<?= base_url(); ?>assets/lightbox2-2.11.1/dist/js/lightbox.js"></script>
    <script src="<?= base_url(); ?>assets/select2-4.0.6-rc.1/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
