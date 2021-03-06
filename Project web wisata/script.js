var a=0;
var b=0;
function show_hide()
{
    if(a==0){
        document.getElementById("profile").style.display="inline";
        document.getElementById("profile").style.animation="0.3s muncul";


        return a=1;
    }else{
        
        document.getElementById("profile").style.animation="0.3s hilang";
        document.getElementById("profile").style.display="none";
        

        return a=0;
    }

}

function sidebar()
{
    if(b==0){
        
        document.getElementById("container1").style.width="0";



        return b=1;
    }else{
        
        document.getElementById("container1").style.width="20%";

        

        return b=0;
    }
}

function sidebartoggle()
{
    if(b==0){
        
        document.getElementById("sidebar").style.width="17%";
        
        document.getElementById("overlay").style.width="100%";




        return b=1;
    }else{
        
        
        document.getElementById("sidebar").style.width="0";
        
        document.getElementById("overlay").style.width="0";

        

        

        return b=0;
    }
}

function editbio()
{
    if(a==0){
        document.getElementById("editbio").style.display="inline";
        document.getElementById("bionow").style.display="none";
        return a=1;
        
    }else{
        document.getElementById("editbio").style.display="none";
        return a=0;
    }
}

function upload()
{
    if(a==0){
        document.getElementById("upload").style.display="inline";
        document.getElementById("uploadback").style.display="block";
        return a=1;
        
    }else{
        document.getElementById("upload").style.display="none";
        document.getElementById("uploadback").style.display="none";
        return a=0;
    }
}

function openpreview(){
    
        document.getElementById("preview").style.display="block";
        document.getElementById("uploadback").style.display="block";
      
}

function closepreview(){
        document.getElementById("preview").style.display="none";
        document.getElementById("uploadback").style.display="none";
        
    
}


var slideIndex = 1;
    var slideFoto = 1;
  
function plusSlides(n) {
    showSlides(slideIndex += n);
    showDelete(slideFoto += n);
}
  
function currentslide(n) {
    showSlides(slideIndex = n);
}


  
function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("fotopre");

    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";

}
var c=0;

function hapusfotoupload(){
    if(c==0){
        
        document.getElementById("menuhapus").style.display="block";



        return c=1;
    }else{
        
        document.getElementById("menuhapus").style.display="none";

        

        return c=0;
    }
}

function currentfoto(n) {
    showDelete(slideFoto = n);
}

function showDelete(n) {
    var i;
    var foto = document.getElementsByClassName("hapus");
    
    if (n > foto.length) {slideFoto = 1}
    if (n < 1) {slideFoto = foto.length}

    for (i = 0; i < foto.length; i++) {
        foto[i].style.display = "none";
    }
    foto[slideFoto-1].style.display = "flex";

}

function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("file-upload").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    }
}




//parallax

$(window).scroll(function(){
    var hScroll=$(this).scrollTop();


    
    
    if(hScroll<$('.intro1').offset().top - 350){
        $('header.move').css({
            'opacity':'0',
            'transform': 'translate(0, -70px)'
        });
        $('header.default').css({
            'opacity':'1',
            'z-index':'3'
        });
    }


    

    if(hScroll>$('.intro1').offset().top - 350){
        $('header.default').css({
            'opacity':'0',
            'z-index':'3'
        });
        $('header.move').css({
            'opacity':'1',
            'z-index':'3',
            'transform': 'translate(0, 0)'
        });
        $('.intro1 .map').addClass('muncul');
        $('.intro1 .textinfo').addClass('muncul');
    }
    
    if(hScroll>$('.intro2').offset().top - 470){
        $('.intro2 .map').addClass('muncul');
        $('.intro2 .textinfo').addClass('muncul');
    }

    if(hScroll>$('.intro3').offset().top - 470){
        $('.intro3 .map').addClass('muncul');
        $('.intro3 .textinfo').addClass('muncul');
    }
    

});


(function() {
    // Add event listener
    document.addEventListener("mousemove", parallax);
    const elem = document.querySelector(".searchbox");
    // Magic happens here
    function parallax(e) {
        let _w = window.innerWidth/2;
        let _h = window.innerHeight/2;
        let _mouseX = e.clientX;
        let _mouseY = e.clientY;
        let _depth1 = `${50 - (_mouseX - _w) * 0.001}% ${50 - (_mouseY - _h) * 0.001}%`;
        let _depth2 = `${50 - (_mouseX - _w) * 0.002}% ${50 - (_mouseY - _h) * 0.002}%`;
        let _depth3 = `${50 - (_mouseX - _w) * 0.004}% ${50 - (_mouseY - _h) * 0.004}%`;
        let x = `${_depth3}, ${_depth2}, ${_depth1}`;
        console.log(x);
        elem.style.backgroundPosition = x;
    }

})();






