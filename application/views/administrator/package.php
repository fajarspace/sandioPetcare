<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Paket Produk</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<a
				href="<?= base_url(); ?>administrator/package/add"
				class="btn rounded-pill btn-primary"
				>Tambah Paket</a
			>
		</div>
		<div class="card-body">
            <?php echo $this->session->flashdata('failed'); ?> 
            <?php if($package->num_rows() > 0){ ?>
			<div class="table-responsive">
				<table
					class="table table-bordered"
					id="dataTable"
					width="100%"
					cellspacing="0"
				>
					<thead>
						<tr>
							<th>#</th>
							<th>Judul</th>
                            <th>Banner</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tfoot></tfoot>
					<tbody class="data-content">
                        <?php $no = 1 ?>
						<?php foreach($package->result_array() as $data): ?>
						<tr>
                            <td><?= $no ?></td>
                            <td><?= $data['title']; ?></td>
							<td><img src="<?= base_url(); ?>assets/images/banner/<?= $data['banner']; ?>" width="300"></td>
                            <td>
								<a href="<?= base_url(); ?>administrator/package/<?= $data['id']; ?>" class="btn rounded-pill btn-sm btn-info"><i class="fa fa-eye"></i></a>
								<a href="<?= base_url(); ?>administrator/delete_package/<?= $data['id']; ?>" class="btn rounded-pill btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus paket ini?')"><i class="fa fa-trash"></i></a>
							</td>
                        </tr>
                        <?php $no++ ?>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning" role="alert">
				Opss, halaman masih kosong, yuk tambah sekarang.
			</div>
            <?php } ?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->