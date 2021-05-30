jQuery(function ($) {
    $('.junuhideshow').on("click",function(){
        if($(this).children('span').hasClass('dashicons-visibility')){
            $(this).children('span').removeClass('dashicons-visibility').addClass('dashicons-hidden');
            $(this).prev('input').attr('type','text');
        }else{
            $(this).children('span').removeClass('dashicons-hidden').addClass('dashicons-visibility');
            $(this).prev('input').attr('type','password');
        }
    });
});