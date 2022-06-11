<main class="container-produk">
<div class="wrapper">
    <div class="navigation">
        <a href="<?= base_url(); ?>">Home</a>
        <i class="fa fa-caret-right"></i>
        <a href="<?= base_url(); ?>c/<?= $product['slug']; ?>"><?= $product['name']; ?></a>
        <i class="fa fa-caret-right"></i>
        <a><?= $product['title']; ?></a>
    </div>

    <?php $setting = $this->db->get('settings')->row_array(); ?>

        <section class="produk">
            <div class="gambar">
              <div class="gambar1">
                <a href="<?= base_url(); ?>assets/images/product/<?=$product['img']; ?>" data-lightbox="img-1">
                    <img src="<?= base_url(); ?>assets/images/product/<?= $product['img']; ?>" alt="produk" class="jumbo-thumb">
                </a>
              <div class="list-gambar">
                <img src="<?= base_url(); ?>assets/images/product/<?= $product['img']; ?>" alt="gambar" class="thumb">
                  <?php foreach($img->result_array() as $d): ?>
                    <img src="<?= base_url(); ?>assets/images/product/<?= $d['img']; ?>" alt="gambar" class="thumb">
                  <?php endforeach; ?>
              </div>
              </div>
            </div>
            <div class="harga">
            <div class="stok-status">
                    <?php
                    if ($product['stock'] > 0 ) {
                        echo 'Stok Barang Ready';
                        ?><script>
                            $(".harga > .stok-status").css("background", "#5BB75B");
                        </script><?php
                    }else{
                        echo 'Stok Barang Habis';
                        ?><script>
                            $(".harga > .stok-status").css("background", "#D9534F");
                        </script><?php
                    }
                    ?>
                </div>
                <div class="judul"><?= $product['title']; ?></div>
                <p class="subtitle">Terjual <?= $product['transaction']; ?> Produk &bull; <?= $product['viewer']; ?>x Dilihat</p>
                <hr>

                    <br>
                    <tr>
                        <td class="t">Stok Tersedia:</td>
                        <td><?= $product['stock']; ?> produk</td>
                    </tr>
                <div class="rp">
                    <table>
                        <?php if($product['stock'] > 0){ ?>
                        <tr>
                        <td>
                            <div class="counter">
                            <button  onclick="minusProduct(<?= $priceP; ?>)">-</button><!--
                        --><input disabled type="text" value="1" id="qtyProduct" class="valueJml"><!--
                        --><button  onclick="plusProduct(<?= $priceP; ?>, <?= $product['stock']; ?>)">+</button>
                        </div>
                        </td>
                    </tr>
                    <tr>
                            <td class="price">Rp <?= str_replace(",",".",number_format($product['price'])); ?></td>
                        </tr>
                    <?php } ?>




                </table>
                </div>
                <div class="stok">

                </div>
                <hr>
                <div class="quant">Quantity :
                    <div class="counter">
                        <span class="down" onClick='decreaseCount(event, this)'>-</span>
                        <input type="number" value="1" >
                        <span class="up" onClick='increaseCount(event, this)'>+</span>
                    </div>
                </div>

                <div class="kirim">
                    <?php if($product['stock'] > 0){ ?>
                    <button class="beli" onclick="buy()"><i class="fa-brands fa-whatsapp"></i> Beli Sekarang</button>
                    <button class="keranjang" onclick="addCart()"><i class="fa-solid fa-cart-plus"></i> Keranjang</button>
                    <?php }else{ ?>
                        <p class="btn rounded-pill btn-outline-secondary">Stok lagi kosong</p>
                        <?php } ?>
                </div>
            </div>
        </section>
        <section class="detail">
            <div class="judul">Detail Produk</div>
            <div class="ket">
                Kondisi:
                <?php if($product['condit'] == 1){ ?>
                <td>Baru</td>
                <?php }else{ ?>
                    <td>Bekas</td>

                <?php } ?><br>
                Berat:
                <?= $product['weight']; ?> gram

                <?= nl2br($product['description']); ?>
            </div>
        </section>


</div>
 </main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    function plusProduct(price, stock){
        let inputJml;
        inputJml = parseInt($("input.valueJml").val());
        inputJml = inputJml + 1;
        if(inputJml <= stock){
            $("input.valueJml").val(inputJml);
            const newPrice = inputJml * price;
            const rpFormat = number_format(newPrice);
            $("#detailTotalPrice").text(rpFormat.split(",").join("."));
        }
    }

    function minusProduct(price){
        let inputJml;
        inputJml = parseInt($("input.valueJml").val());
        inputJml = inputJml - 1;
        if(inputJml >= 1){
            $("input.valueJml").val(inputJml);
            const newPrice = inputJml * price;
            const rpFormat = number_format(newPrice);
            $("#detailTotalPrice").text(rpFormat.split(",").join("."));
        }
    }

    function number_format (number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
        var s = ''

        var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
            .toFixed(prec)
        }

        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }

    function buy(){
        $.ajax({
            url: "<?= base_url(); ?>cart/add_to_cart",
            type: "post",
            data: {
                id: <?= $product['productId']; ?>,
                qty: $("#qtyProduct").val()
            },
            success: function(data){
                location.href = "<?= base_url(); ?>cart"
            }
        })
    }

    function addCart(){
        $.ajax({
            url: "<?= base_url(); ?>cart/add_to_cart",
            type: "post",
            data: {
                id: <?= $product['productId']; ?>,
                qty: $("#qtyProduct").val()
            },
            success: function(data){
                $(".navbar-cart-inform").html(`<i class="fa fa-shopping-cart"></i> Keranjang(<?= count($this->cart->contents()) + 1; ?>)`);
                swal({
                    title: "Berhasil Ditambah ke Keranjang",
                    text: `<?= $product['title']; ?>`,
                    icon: "success",
                    buttons: true,
                    buttons: ["Lanjut Belanja", "Lihat Keranjang"],
                    })
                    .then((cart) => {
                    if (cart) {
                        location.href = "<?= base_url(); ?>cart"
                    }
                });
            }
        })
    }

    // list gambar
    const containerImgProduct = document.querySelector("div.gambar1");
    const jumboImgProduct = document.querySelector("div.gambar1 img.jumbo-thumb");
    const jumboHrefImgProduct = document.querySelector("div.gambar1 a");
    const thumbsImgProduct = document.querySelectorAll("div.gambar1 div.list-gambar img.thumb");

    containerImgProduct.addEventListener('click', function(e){
        if(e.target.className == 'thumb'){
            jumboImgProduct.src = e.target.src;
            jumboHrefImgProduct.href = e.target.src;

            thumbsImgProduct.forEach(function(thumb){
                thumb.className = 'thumb';
            })
        }
    })

</script>
