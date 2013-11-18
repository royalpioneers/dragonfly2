$(function (){
    $(".search-query").keypress(function(e){
        if (e.which == 13) { 
            query = $(".search-query").val();
            $.ajax({
                type: "POST",
                url: "http://localhost/public/pages/product/product_list.php",
                data: { query : query },
                beforeSend: function() {
                    $('#loading').show();            
                }
            })
            .done(function( html ) {
                $('.content-product').html(html);
            });
        }
    });
});
