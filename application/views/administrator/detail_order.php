<?php echo $this->session->flashdata('upload'); ?>
<?php
$id = $invoice['province'];
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://pro.rajaongkir.com/api/province?id=$id",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
    "key: ". $this->Settings_model->general()["api_rajaongkir"]
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $response =  json_decode($response, true);
    $province = $response['rajaongkir']['results']['province'];
}

$id = $invoice['regency'];
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://pro.rajaongkir.com/api/city?id=$id",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
    "key: ". $this->Settings_model->general()["api_rajaongkir"]
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $response =  json_decode($response, true);
    $regency = $response['rajaongkir']['results']['type'] . ' ' . $response['rajaongkir']['results']['city_name'];
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-2">Invoice ID = <?= $invoice['invoice_code']; ?></h1>
    <?php if($invoice['courier'] == 'cod'){ ?>
    <?php }else{ ?>
    <?php if($invoice['send'] == 1){ ?>
        <h3 class="text-success">Transaksi Selesai</h3>
    <?php } ?>
    <?php } ?>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <a href="<?= base_url(); ?>administrator/orders" class="btn rounded-pill btn-sm btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
            <a href="<?= base_url(); ?>administrator/print_detail_order/<?= $invoice['invoice_code']; ?>" class="btn rounded-pill btn-info btn-sm float-right">Print</a>
		</div>
		<div class="card-body">
            <h3 class="lead">Data Alamat</h3>
            <hr>
            <?php if($invoice['label'] == ""){ ?>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td>Nama Penerima</td>
                                <td><?= $invoice['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td><?= $invoice['telp']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td style="width: 65%"><?= $invoice['address']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td>Nama Penerima</td>
                                <td><?= $invoice['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td><?= $invoice['telp']; ?></td>
                            </tr>
                            <tr>
                                <td>Provinsi</td>
                                <td><?= $province; ?></td>
                            </tr>
                            <tr>
                                <td>Kabupaten/Kota</td>
                                <td><?= $regency; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td>Kecamatan</td>
                                <td><?= $invoice['district']; ?></td>
                            </tr>
                            <tr>
                                <td>Desa/Kelurahan</td>
                                <td><?= $invoice['village']; ?></td>
                            </tr>
                            <tr>
                                <td>Kode Post</td>
                                <td><?= $invoice['zipcode']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td style="width: 65%"><?= $invoice['address']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php if($data['courier'] != ""){ ?>
                <hr><hr>
                <h3 class="lead">Metode Pengiriman</h3>
                <hr>
                <div class="row">
                    <div class="col-md-10">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td>Ekspedisi</td>
                                <?php if($invoice['courier'] == "jne"){ ?>
                                    <td>Jalur Nugraha Ekakurir (JNE)</td>
                                <?php }else if($invoice['courier'] == "pos"){ ?>
                                    <td>POS Indonesia (POS)</td>
                                <?php }else if($invoice['courier'] == "tiki"){ ?>
                                    <td>Citra Van Titipan Kilat (TIKI)</td>
                                <?php }else if($invoice['courier'] == "sicepat"){ ?>
                                    <td>SiCepat Express (SICEPAT)</td>    
                                <?php }else if($invoice['courier'] == "jnt"){ ?>
                                    <td>J&T Express (J&T)</td>
                                <?php }else if($invoice['courier'] == "sap"){ ?>
                                    <td>SAP Express (SAP)</td>
                                <?php }else if($invoice['courier'] == "ninja"){ ?>
                                    <td>Ninja Xpress (NINJA)</td>
                                <?php }else if($invoice['courier'] == "lion"){ ?>
                                    <td>Lion Parcel (LION)</td>
                                <?php }else if($invoice['courier'] == "anteraja"){ ?>
                                    <td>AnterAja (ANTERAJA)</td>
                                <?php }else if($invoice['courier'] == "rpx"){ ?>
                                    <td>RPX Holding (RPX)</td>
                                <?php }else if($invoice['courier'] == "pandu"){ ?>
                                    <td>Pandu Logistics (PANDU)</td>
                                <?php }else if($invoice['courier'] == "wahana"){ ?>
                                    <td>Wahana Prestasi Logistik (WAHANA)</td>
                                <?php }else if($invoice['courier'] == "pahala"){ ?>
                                    <td>Pahala Kencana Express (PAHALA)</td>
                                <?php }else if($invoice['courier'] == "jet"){ ?>
                                    <td>JET Express (JET)</td>
                                <?php }else if($invoice['courier'] == "dse"){ ?>
                                    <td>21 Express (DSE)</td>
                                <?php }else if($invoice['courier'] == "slis"){ ?>
                                    <td>Solusi Ekspres (SLIS)</td>
                                <?php }else if($invoice['courier'] == "first"){ ?>
                                    <td>First Logistics (FIRST)</td>
                                <?php }else if($invoice['courier'] == "ncs"){ ?>
                                    <td>Nusantara Card Semesta (NCS)</td>
                                <?php }else if($invoice['courier'] == "star"){ ?>
                                    <td>Star Cargo (STAR)</td>
                                <?php }else if($invoice['courier'] == "idl"){ ?>
                                    <td>IDL Cargo (IDL)</td>
                                <?php }else if($invoice['courier'] == "rex"){ ?>
                                    <td>Royal Express Indonesia (REX)</td>
                                <?php }else if($invoice['courier'] == "ide"){ ?>
                                    <td>ID Express (IDE)</td>
                                <?php }else if($invoice['courier'] == "sentral"){ ?>
                                    <td>Sentral Cargo (SENTRAL)</td>
                                <?php }else if($invoice['courier'] == "antar"){ ?>
                                    <td>Diantar oleh penjual</td>
                                <?php }else{ ?>
                                    <td>Jasa kurir tidak dikenal, silakan hubungi pembeli.</td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Layanan</td>
                                <?php if($invoice['courier'] == "antar"){ ?>
                                    <td>-</td>
                                <?php }else{ ?>
                                    <td><?= $invoice['courier_service']; ?></td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
		</div>
	</div>
    <div class="card shadow mb-5">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Ket</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                <?php $no=1; foreach($orders->result_array() as $data): ?>
                </tr>
                    <td><?= $no; ?></td>
                    <td><?= $data['product_name']; ?></td>
                    <td class="text-center"><?= $data['qty']; ?></td>
                    <?php if($data['ket'] == ""){ ?>
                        <td>-</td>
                    <?php }else{ ?>
                        <td><?= $data['ket']; ?></td>
                    <?php } ?>
                    <td>Rp <?= number_format($data['price'],0,",","."); ?></td>
                    <?php $total = $data['price'] * $data['qty']; ?>
                    <td>Rp <?= number_format($total,0,",","."); ?></td>
                    <td>
                        <a href="<?= base_url(); ?>p/<?= $data['slug']; ?>" target="_blank" class="btn rounded-pill btn-sm btn-success"><i class="fa fa-eye"></i></a>
                    </td>
                <tr>
                <?php $no++; endforeach; ?>
                </tr>
            </table>
            <div class="col-md-6">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th>Total Harga</th>
                        <th>Rp <?= number_format($invoice['total_price'],0,",","."); ?></th>
                    </tr>
                    <tr>
                    <?php if($invoice['label'] == "" || $invoice['courier'] == ""){ ?>
                        <th>Biaya Ongkir</th>
                        <th>Rp <?= number_format($invoice['ongkir'],0,",","."); ?></th>
                        </tr>
                    <?php }else{ ?>
                        <?php if($invoice['courier'] == "antar"){ ?>
                            <th>Biaya Ongkir (Diantar oleh penjual)</th>
                        <?php }else{ ?>
                            <th>Biaya Ongkir (<?= strtoupper($invoice['courier']); ?> <?= $invoice['courier_service']; ?>)</th>
                        <?php } ?>
                            <th>Rp <?= number_format($invoice['ongkir'],0,",","."); ?></th>
                        </tr>    
                    <?php } ?>
                    <tr>
                        <th>Total Keseluruhan</th>
                        <th>Rp <?= number_format($invoice['total_all'],0,",","."); ?></th>
                    </tr>
                </table>
            </div>
            <hr>
            <?php if($invoice['send'] == 0 && $invoice['process'] == 0){ ?>
            <a href="<?= base_url(); ?>administrator/finish_orderan/<?= $invoice['invoice_code']; ?>" onclick="return confirm('Yakin ingin menyelesaikan pesanan?');" class="btn rounded-pill btn-info btn-sm">Selesai</a>
            <?php } ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
