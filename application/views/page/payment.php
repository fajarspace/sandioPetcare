<form action="<?= base_url(); ?>payment/succesfully" method="post">
<div class="wrapper">
    <div class="core">
        <?php if($this->cart->total_items() > 0){ ?>
        <div class="products">
            <table class="table">
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Ket</th>
                    <th>Harga</th>
                </tr>
                <?php foreach($this->cart->contents() as $item): ?>
                <tr>
                    <td># <?= $item['name']; ?></td>
                    <td class="text-center"><?= $item['qty']; ?></td>
                    <?php if($item['ket'] == ""){ ?>
                        <td>-</td>
                    <?php }else{ ?>
                        <td><?= $item['ket']; ?></td>
                    <?php } ?>
                    <td>Rp<?= number_format($item['subtotal'],0,",","."); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="line"></div>
        <div class="address">
            <h2 class="title">Alamat Pengiriman</h2>
            <hr>
            <div class="form-group">
                <label for="paymentSelectProvinces">Provinsi</label><br>
                <select style="display: block;width: 100%" name="paymentSelectProvinces" id="paymentSelectProvinces" class="form-control" required>
                    <option></option>
                    <?php foreach($provinces as $p): ?>
                        <option value="<?= $p['province_id']; ?>"><?= $p['province']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php if($setting['ongkir'] == 0){ ?>
            <div class="form-group">
                <label for="paymentSelectRegenciesOngkir">Kota/Kabupaten</label><br>
                <select style="display: block;width: 100%" name="paymentSelectRegenciesOngkir" id="paymentSelectRegenciesOngkir" class="form-control" required>
                    <option></option>
                </select>
            </div>
            <?php }else{ ?>
            <div class="form-group">
                <label for="paymentSelectRegencies">Kota/Kabupaten</label><br>
                <select style="display: block;width: 100%" name="paymentSelectRegencies" id="paymentSelectRegencies" class="form-control" required>
                    <option></option>
                </select>
            </div>
            <?php } ?>
            <div class="form-group">
                <label for="district">Kecamatan</label>
                <input type="text" class="form-control" autocomplete="off" id="district" name="district" placeholder="Nama Kecamatan" required>
            </div>
            <div class="form-group">
                <label for="village">Desa/Kelurahan</label>
                <input type="text" class="form-control" autocomplete="off" id="village" name="village" placeholder="Nama Desa/Kelurahan" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat Lengkap</label>
                <input type="text" class="form-control" autocomplete="off" id="address" name="address" placeholder="Alamat Jalan / No. RT RW / No. Rumah" required>
            </div>
            <div class="form-group">
                <label for="zipcode">Kode Pos</label>
                <input type="number" class="form-control" autocomplete="off" id="zipcode" name="zipcode" placeholder="Kode Pos" required>
            </div>
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" autocomplete="off" id="name" name="name" placeholder="Nama Penerima" required>
            </div>
            <div class="form-group">
                <label for="telp">Nomor Telepon</label>
                <input type="number" class="form-control" autocomplete="off" id="telp" name="telp" placeholder="No Telp. / WA" required>
            </div>

            <?php if($setting['ongkir'] != 0){ ?>
            <div class="line mt-4"></div>
            <div class="send">
                <h2 class="title">Metode Pengiriman</h2>
                <small class="text-danger" id="paymentTextNotSupportDelivery" style="display: none;">Metode antar belum tersedia untuk tempat Anda.</small>
                <div class="form-group mt-3" id="groupPaymentSelectKurir">
                    <select name="paymentSelectKurir" id="paymentSelectKurir" class="form-control" required>
                        <option></option>
                    </select>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php }else{ ?>
            <div class="alert alert-warning">Upss. Kamu belum memiliki satupun belanjaan. Yuk belanja dulu.</div>
        <?php } ?>
    </div>
    <div class="total shadow">
        <h2 class="title">Ringkasan Belanja</h2>
        <hr>
        <div class="list">
            <p>Total Belanja</p>
            <p>Rp<?= number_format($this->cart->total(),0,",","."); ?></p>
        </div>
        <?php if($setting['ongkir'] == 0){ ?>
            <div class="list">
            <p>Biaya Pengiriman</p>
            <p id="paymentSendingPriceOngkir">Rp0</p>
            </div>
            <hr>
            <div class="list">
                <p>Total Tagihan</p>
                <p id="paymentTotalAll">Rp<?= number_format($setting['default_ongkir'] + $this->cart->total(),0,",","."); ?></p>
            </div>
        <?php }else{ ?>
            <div class="list">
                <p>Biaya Pengiriman</p>
                <p id="paymentSendingPrice">Rp0</p>
            </div>
            <hr>
            <div class="list">
                <p>Total Tagihan</p>
                <p id="paymentTotalAll">Rp<?= number_format($this->cart->total(),0,",","."); ?></p>
            </div>
        <?php } ?>
        <?php if($this->cart->total_items() > 0){ ?>
            <button class="btn rounded-pill btn-dark btn-block mt-2" id="btnPaymentNow" type="submit">Lanjutkan</button>
        <?php }else{ ?>
            <div class="alert mt-2 alert-warning">Keranjangmu masih kosong.</div>
            <a href="<?= base_url(); ?>">
                <button class="btn rounded-pill btn-dark btn-block mt-2">Belanja Dulu</button>
            </a>
        <?php } ?>
    </div>
</div>
</form>