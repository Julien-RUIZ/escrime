


$(document).ready(function(){



    //-------------------------------------------
    $(".texteActus3").mouseover(function(){
        $(this).css('background-color','rgb(234, 233, 233)');
    })
    $(".texteActus3").mouseout(function(){
        $(this).css('background-color','white');
    })

$(".texteactus1").click(function(){
    $(this).css('color-webkit-line-clamp','0');
})
    //-------------------------------------------



    $(".imageUne").mouseover(function(){
        $(".titreUn").css('fontSize','22px');
    })
    $(".imageUne").mouseout(function(){

        $(".titreUn").css('fontSize','16px');
    })
//-------------------------------------------
    $(".imageDeux").mouseover(function(){

        $(".titreDeux").css('fontSize','22px');
    })
    $(".imageDeux").mouseout(function(){

        $(".titreDeux").css('fontSize','16px');
    })
//-------------------------------------------
    $(".imageTrois").mouseover(function(){

        $(".titreTrois").css('fontSize','22px');
    })
    $(".imageTrois").mouseout(function(){

        $(".titreTrois").css('fontSize','16px');
    })
//-------------------------------------------
    $(".imageQuatre").mouseover(function(){

        $(".titreQuatre").css('fontSize','22px');
    })
    $(".imageQuatre").mouseout(function(){

        $(".titreQuatre").css('fontSize','16px');
    })

    //--------------------------------------------
    $(".LienDansImage").hide();
    $(".LienDansImage1").hide();
    $(".LienDansImage2").hide();
    $(".LienDansImage3").hide();



    $("div.borderGeneric").click(function(){
        if($(this).hasClass('imageUne')) {


        }
        else if ($(this).hasClass('imageDeux')){
            $(".LienDansImage1").slideToggle();
            $(".LienDansImage2").slideUp();
            $(".LienDansImage3").slideUp();


        }
        else if ($(this).hasClass('imageTrois')){
            $(".LienDansImage2").slideToggle();
            $(".LienDansImage1").slideUp();
            $(".LienDansImage3").slideUp();

        }
        else if ($(this).hasClass('imageQuatre')){
            $(".LienDansImage3").slideToggle();
            $(".LienDansImage1").slideUp();
            $(".LienDansImage2").slideUp();

        }})









})













































