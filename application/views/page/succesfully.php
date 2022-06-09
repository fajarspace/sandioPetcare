<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-7">
            <h3 class="title">Terima Kasih Telah Berbelanja di <?= $this->Settings_model->general()["app_name"]; ?></h3>
            <hr>
            <?php if($metod == 'cod'){ ?>
                <h4>Silakan hubungi kami melalui Whatsapp dengan klik tombol dibawah</h4>
                <a href="https://wa.me/send?phone=<?= $this->Settings_model->general()["whatsappv2"]; ?>&text=Kode Pesanan <?= $invoice_id['invoice']; ?>" class="btn rounded-pill btn-sm btn-dark">Whatsapp</a>
            <?php }else{ ?>
                <h4>Kode Pesanan Anda adalah <?= $invoice_id['invoice']; ?></h4>
            <p>Kami telah mengirimkan email kepada Anda yang berisi tagihan pesanan. Cek folder Inbox atau Spam untuk melihat email yang kami kirim.</p>
            <hr>
            <strong>Mohon untuk melakukan pembayaran sebesar <h5 class="text-primary">Rp <?= number_format($invoice_id['total'],0,",","."); ?></h5> ke rekening dibawah ini (pilih salah satu): </strong>
            <?php foreach($rekening->result_array() as $r): ?>
                <p><strong><?= $r['rekening']; ?></strong><br/>
                Atas Nama : <?= $r['name']; ?><br/>
                No Rekening : <?= $r['number']; ?></p>
            <?php endforeach; ?>
            <p>Jika sudah melakukan pembayaran, silakan konfirmasi melalui Whatsapp <?= $this->Settings_model->general()["whatsapp"] ?> atau <a href="https://wa.me/<?= $this->Settings_model->general()["whatsappv2"] ?>">klik disini</a> dengan format sebagai berikut:</p> 
            <table>
                <tr>
                    <td>1. Kode Pesanan : <strong><?= $invoice_id['invoice']; ?></strong></td>
                </tr>
                <tr>
                    <td>2. Nama Pemilik Rekening : </td>
                </tr>
                <tr>
                    <td>3. Transfer Dari Bank : </td>
                </tr>
                <tr>
                    <td>4. Transfer Ke Bank : </td>
                </tr>
                <tr>
                    <td>Sertakan juga bukti transfer</td>
                </tr>
            </table></p>
            <?php } ?>
        </div>
    </div>

</div>