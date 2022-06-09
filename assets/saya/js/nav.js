var isActive = false;
$('.nav-kategori div').on('click',function(){
    if(isActive){
        $(".list-kategori").css("display", "none");
        $(".nav-kategori div i").css("transform", "rotate(0deg)");
    }else{
        $(".list-kategori").css("display", "block");
		$(".nav-kategori div i").css("transform", "rotate(180deg)");
    }
    isActive = !isActive;
});
var isActive = false;
$('.nav-hamburger').on('click',function(){
    if(isActive){
        $(".list-kategori-mobile").css("display", "none");
        $(".nav-hamburger i:nth-child(2)").css("display", "none");
        $(".nav-hamburger i:nth-child(1)").css("display", "block");
        $(".list-kategori-mobile ul").css("transform", "translateX(30rem)");
    }else{
        $(".list-kategori-mobile").css("display", "block");
        $(".nav-hamburger i:nth-child(2)").css("display", "block");
        $(".nav-hamburger i:nth-child(1)").css("display", "none");
        $(".list-kategori-mobile ul").css("transform", "translateX(0)");
    }
    isActive = !isActive;
});