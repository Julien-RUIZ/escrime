


$(document).ready(function(){



    //----------Partie accueil.html modif des actus
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


    //-----------Action jquery pour la partie base.html
    $(".imageUne").mouseover(function(){
        //modif taille titre
        $(".titreUn").css('fontSize','22px');
    })
    $(".imageUne").mouseout(function(){

        $(".titreUn").css('fontSize','16px');
    })
//-------------------------------------------
    $(".imageDeux").mouseover(function(){
        //modif taille titre
        $(".titreDeux").css('fontSize','22px');
        //modif forme curseur sur l'image
        $(this).css('cursor','pointer');
    })
    $(".imageDeux").mouseout(function(){

        $(".titreDeux").css('fontSize','16px');
    })
//-------------------------------------------
    $(".imageTrois").mouseover(function(){
        $(this).css('cursor','pointer');
        //modif forme curseur sur l'image
        $(".titreTrois").css('fontSize','22px');
    })
    $(".imageTrois").mouseout(function(){

        $(".titreTrois").css('fontSize','16px');
    })
//-------------------------------------------
    $(".imageQuatre").mouseover(function(){
        $(this).css('cursor','pointer');
        //modif forme curseur sur l'image
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













































