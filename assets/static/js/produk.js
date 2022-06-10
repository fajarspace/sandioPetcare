$('.list-gambar > .produk1').on('click',function(){
    $(this).addClass('aktif');
	$('.gambar-besar > .produk1').addClass('aktif');

    $('.list-gambar > .produk2').removeClass('aktif');
    $('.gambar-besar > .produk2').removeClass('aktif');
    
    $('.list-gambar > .produk3').removeClass('aktif');
    $('.gambar-besar > .produk3').removeClass('aktif');
});

$('.list-gambar > .produk2').on('click',function(){
    $(this).addClass('aktif');
    $('.gambar-besar > .produk2').addClass('aktif');

    $('.list-gambar > .produk1').removeClass('aktif');
    $('.gambar-besar > .produk1').removeClass('aktif');

    $('.list-gambar > .produk3').removeClass('aktif');
    $('.gambar-besar > .produk3').removeClass('aktif');
});

$('.list-gambar > .produk3').on('click',function(){
    $(this).addClass('aktif');
    $('.gambar-besar > .produk3').addClass('aktif');

    $('.list-gambar > .produk1').removeClass('aktif');
    $('.gambar-besar > .produk1').removeClass('aktif');

    $('.list-gambar > .produk2').removeClass('aktif');
    $('.gambar-besar > .produk2').removeClass('aktif');
});


function increaseCount(a, b) {
    var input = b.previousElementSibling;
    var value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
}

function decreaseCount(a, b) {
    var input = b.nextElementSibling;
    var value = parseInt(input.value, 10);
    if (value > 1) {
        value = isNaN(value) ? 0 : value;
        value--;
        input.value = value;
    }
}