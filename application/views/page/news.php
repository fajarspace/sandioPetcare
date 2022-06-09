<div class="wrapper">
    <div class="top">
        <p class="lead">Berita</p>
    </div>
    <div class="main">
        <?php foreach($news->result_array() as $n): ?>
            <a href="<?= $n['url']; ?>" target="_blank">
                <img src="<?= base_url(); ?>assets/images/banner/<?= $n['img']; ?>" alt="banner">
            </a>
        <?php endforeach; ?>
    </div>
</div>