$(document).ready(function(){
    
    /** ===== Сортировка ===== */
    $("#param_order").toggle(
        function() {
            $(".sort-wrap").css({'visibility': 'visible'});
        },
        function() {
            $(".sort-wrap").css({'visibility': 'hidden'});
        }
    );
    /** ===== Сортировка ===== */   

});