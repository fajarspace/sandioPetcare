<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid mb-5">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Pengaturan</h1>

	<div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                <?php include('menu-setting.php') ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header">
                    <?php if($setting['ongkir'] == 0){ ?>
                        <a href="<?= base_url(); ?>administrator/setting/ongkir/status" class="btn rounded-pill btn-sm btn-primary float-left mr-2">Aktifkan Ongkir</a>
                    <?php }else{ ?>
                        <a href="<?= base_url(); ?>administrator/setting/ongkir/status" class="btn rounded-pill btn-sm btn-danger float-left mr-2">Matikan Ongkir</a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>administrator/setting/ongkir" method="post">
                        <div class="form-group">
                            <label for="ongkir">Default nominal ongkis kirim akan digunakan ketika ongkir dimatikan.</label>
                            <input type="number" value="<?= $setting['default_ongkir']; ?>" name="ongkir" class="form-control" id="ongkir">
                            <small class="text-muted">Isikan tanpa tanda pemisah. Contoh: 25000 (Gunakan angka 0 untuk ongkir gratis)</small>
                        </div>
                        <button type="submit" class="btn rounded-pill btn-info"><i class="fa fa-save"></i> Simpan Default</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
