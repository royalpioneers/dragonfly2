<?php
include '../../../private/conexion.php';
$pdo = DataBase::connect();  
$productName = $_POST['q'];

 ?>
<!DOCTYPE html>
<html lang="es">
<head>  
    <title>List Importer</title>
    <script type="text/javascript">
            $(document).ready(function(){
                function loading_show(){
                    $('#loading').html("<img src='public/img/loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "POST",
                        url: "public/pages/product/load_producto.php",
                        data: {page : page, q : '<?php echo $productName; ?>'},
                        success: function(msg)
                        {
                            $("#containerdata2").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#containerdata2").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#containerdata2 .pagination2 li.active').live('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);
                    
                });           
                $('#go_btn2').live('click',function(){
                    var page = parseInt($('.goto2').val());
                    var no_of_pages = parseInt($('.total2').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto2').val("").focus();
                        return false;
                    }
                    
                });
            });
        </script>
</head>
<body>
    <div id="loading"></div>
    <div id="containerdata2">        
        
    </div>  
    
</body>



</html>