<?php echo $this->session->flashdata('upload'); ?>
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h4 mb-2 text-gray-800 mb-4"><?= $package['title']; ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <p class="lead mb-0 pb-0">Produk</p>
                </div>
                <div class="card-body">
                    <?php if($packdata->num_rows() > 0){ ?>
                    <div class="row">
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
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot></tfoot>
                                <tbody class="data-content">
                                    <?php $no = 1 ?>
                                    <?php foreach($packdata->result_array() as $data): ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><img src="<?= base_url(); ?>assets/images/product/<?= $data['img']; ?>" width="50"></td>
                                        <td><a href="<?= base_url(); ?>p/<?= $data['slug']; ?>" target="_blank" class="text-dark"><?= $data['title']; ?></a></td>
                                        <td><a href="<?= base_url(); ?>administrator/delete_package_data/<?= $data['packId']; ?>/<?= $data['package'] ?>" class="btn rounded-pill btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $no++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php }else{ ?>
                        <div class="alert alert-warning">Belum ada produk untuk <?= $product['title']; ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <p class="lead mb-0 pb-0">Tambah Produk</p>
                </div>
                <div class="card-body">
                    <?php echo $this->session->flashdata('failed'); ?>
                    <form action="<?= base_url(); ?>administrator/package/<?= $package['id']; ?>" method="post">
                        <div class="form-group">
                            <select style="width: 100%" name="product" id="selectProductForAddPackage" class="form-control" required>
                                <option></option>
                                <?php foreach($allproduct->result_array() as $d): ?>
                                    <?php $isada = $this->db->get_where('package_product', ['product' => $d['id'], 'package' => $package['id']])->row_array(); ?>
                                    <?php if(!$isada){ ?>
                                        <option value="<?= $d['id'] ?>"><?= $d['title']; ?></option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn rounded-pill btn-sm btn-info" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>