<main class="container-cart" >
<div class="wrapper-cart">
    <div class="navigation">
        <a href="<?= base_url(); ?>">Home</a>
        <i class="fa fa-caret-right"></i>
        <a>Troli</a>
    </div>
    <div class="core-cart">
        <div class="product-cart">
            <?php if($this->cart->total_items() > 0){ ?>
            <?php foreach($this->cart->contents() as $item): ?>
            <div class="item-main">
                <img src="<?= base_url(); ?>assets/images/product/<?= $item['img']; ?>" alt="">
                <div>
                    <a class="nama-barang" href="<?= base_url(); ?>p/<?= $item['slug']; ?>"><h2 class="title mb-0"><?= $item['name']; ?></h2></a>
                    <small class="text-muted">Jumlah: <?= $item['qty']; ?></small>
                    <h3 class="price mt-0 mb-0">Rp <?= number_format($item['subtotal'],0,",","."); ?></h3>
                    <div class="aksi">
                        <?php if($item['ket'] == ''){ ?>
                            <small class="desc_product_<?= $item['rowid']; ?>">
                                <a href="#" class="text-dark" data-toggle="modal" data-target="#modalAddDescription" onclick="showModalAddKet('<?= $item['rowid']; ?>')">tulis catatan</a>
                            </small>
                        <?php }else{ ?>
                            <small class="desc_product_<?= $item['rowid']; ?>">Ket: <?= $item['ket']; ?>
                                <a href="#" class="text-dark" data-toggle="modal" data-target="#modalEditDescription" onclick="showModalEditKet('<?= $item['rowid']; ?>')">
                                    <i class="fa text-info fa-edit"></i>
                                </a>
                            </small>
                        <?php } ?>
                        <a class="delete-item" href="<?= base_url(); ?>cart/delete/<?= $item['rowid']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini dari troli?')"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <a class="deleteall" href="<?= base_url(); ?>cart/delete_cart" onclick="return confirm('Apakah Anda yakin akan mengosongkan Troli?')"><button class="btn rounded-pill btn-outline-dark"><i class="fa-solid fa-trash"></i> Hapus Semua</button></a>
            <?php }else{ ?>
                <div class="alert alert-warning">Upss.. Keranjang Masih Kosong. Yuk Belanja Terlebih Dahulu...!</div>
                <br><br><br>
            <?php } ?>
        </div>
    </div>
</div>
<div class="total-cart shadow">
    <h2 class="title">Ringkasan Belanja</h2>
    <div class="list">
        <p>Total Jumlah</p>
        <p>(<?= $this->cart->total_items(); ?> Barang)</p>
    </div>
    <div class="list">
        <p>Total Tagihan</p>
        <p>Rp <?= number_format($this->cart->total(),0,",","."); ?></p>
    </div>
    <?php if($this->cart->total_items() > 0){ ?>
        <a href="<?= base_url(); ?>payment" class="lanjut">
            <button class="btn rounded-pill btn-dark btn-block mt-2">Lanjut Pembayaran</button>
        </a>
    <?php }else{ ?>
        <a href="<?= base_url(); ?>" class="belanja">
            <button class="btn rounded-pill btn-dark btn-block mt-2">Belanja Dulu</button>
        </a>
    <?php } ?>
</div>
</main>

<!-- Modal -->
<div class="modal fade" id="modalEditDescription" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Deskripsi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="bodyModalEditKet">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn rounded-pill btn-primary" id="btnEditKetProduct" data-dismiss="modal">Simpan</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAddDescription" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Deskripsi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="bodyModalAddKet">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn rounded-pill btn-primary" id="btnSaveKetProduct" data-dismiss="modal">Simpan</button>
        </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>

    function showModalAddKet(id){
        $("#bodyModalAddKet").html(`<div class="form-group">
            <textarea name="ket_product" id="ket_product" class="form-control form-control-sm" placeholder="Model, ukuran, warna, dll."></textarea>
            <input type="hidden" id="rowid_pro" value=${id}>
        </div>`);
    }

    function showModalEditKet(id){
        $.ajax({
            url: "<?= base_url(); ?>cart/get_item",
            type: "post",
            dataType: "json",
            data: {
                rowid: id
            },
            success: function(res){
                $("#bodyModalEditKet").html(`<div class="form-group">
                    <textarea name="ket_product" id="ket_product_edit" class="form-control form-control-sm" placeholder="Model, ukuran, warna, dll.">${res.ket}</textarea>
                    <input type="hidden" id="rowid_pro_edit" value=${id}>
                </div>`);      
            }
        })
    }

    $("#btnSaveKetProduct").on('click', function(){
        const rowid = $("#rowid_pro").val();
        const ket = $("#ket_product").val();
        $.ajax({
            url: "<?= base_url(); ?>cart/add_ket",
            type: "post",
            data: {
                rowid: rowid,
                ket: ket
            },
            success: function(){
                $("small.desc_product_"+rowid).html("ket: " + ket + ` <a href="#" class="text-dark" data-toggle="modal" data-target="#modalEditDescription" onclick="showModalEditKet('${rowid}')"><i class="fa text-info fa-edit"></i></a>`);
            }
        })
    })

    $("#btnEditKetProduct").on('click', function(){
        const rowid = $("#rowid_pro_edit").val();
        const ket = $("#ket_product_edit").val();
        $.ajax({
            url: "<?= base_url(); ?>cart/add_ket",
            type: "post",
            data: {
                rowid: rowid,
                ket: ket
            },
            success: function(){
                $("small.desc_product_"+rowid).html("ket: " + ket + ` <a href="#" class="text-dark" data-toggle="modal" data-target="#modalEditDescription" onclick="showModalEditKet('${rowid}')"><i class="fa text-info fa-edit"></i></a>`);
            }
        })
    })

</script>