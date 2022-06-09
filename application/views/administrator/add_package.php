<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Tambah Paket Produk</h1>

    <div class="card shadow">
        <div class="card-header py-3">
			<a
				href="<?= base_url(); ?>administrator/package"
				class="btn rounded-pill btn-danger"
				><i class="fa fa-times-circle"></i> Batal</a
			>
		</div>
        <div class="card-body">
            <?php echo $this->session->flashdata('failed'); ?>
            <form action="<?= base_url(); ?>administrator/package/add" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" name="title" autocomplete="off" id="title" required>
                </div>
                <div class="form-group">
                    <label for="img">Banner</label>
                    <input type="file" name="img" id="img" class="form-control" required>
                    <small class="text-muted">Pastikan gambar berukuran maksimal 2mb, berformat png, jpg, jpeg.</small>
                </div>
                <button type="submit" class="btn rounded-pill btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
