<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Data Pesanan</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
		</div>
		<div class="card-body">
            <?php echo $this->session->flashdata('failed'); ?> 
            <?php if($orders->num_rows() > 0){ ?>
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
							<th>Kode/Invoice</th>
							<th>Nama</th>
							<th>Total Pesanan</th>
                            <th>Tanggal Pesan</th>
                            <th>Status</th>
                            <th>Aksi</th>
						</tr>
					</thead>
					<tfoot></tfoot>
					<tbody class="data-content">
						<?php $no = $this->uri->segment(3) + 1; ?>
						<?php foreach($orders->result_array() as $data): ?>
						<tr>
							<td><?= $no; ?></td>
                            <td><?= $data['invoice_code']; ?></td>
                            <td><?= $data['name']; ?></td>
                            <td>Rp <?= number_format($data['total_all'],0,",","."); ?></td>
                            <td><?= $data['date_input']; ?></td>
							<?php if($data['courier'] == 'cod'){ ?>
								<td>COD (Cash of Delivery)</td>
							<?php }else{ ?>
								<?php if($data['process'] == 0 && $data['send'] == 0){ ?>
									<td>Belum di proses</td>
								<?php }else if($data['process'] == 1 && $data['send'] == 0){ ?>
									<td>Sedang di proses</td>
								<?php }else{ ?>
									<td><span class="btn rounded-pill btn-sm btn-success">Selesai</span></td>
								<?php } ?>
							<?php } ?>
                            <td>
                                <a href="<?= base_url() ;?>administrator/order/<?= $data['invoice_code']; ?>" class="btn rounded-pill btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
						<?php $no++; ?>
                        <?php endforeach; ?>
					</tbody>
				</table>
				<?= $this->pagination->create_links(); ?>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning" role="alert">
				Opss, pesanan masih kosong.
			</div>
            <?php } ?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
