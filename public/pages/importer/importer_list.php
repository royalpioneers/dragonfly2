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
                        url: "public/pages/importer/load_importer.php",
                        data: {page : page, q : '<?php echo $productName; ?>'},
                        success: function(msg)
                        {
                            $("#containerdata").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#containerdata").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#containerdata .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);
                    
                });           
                $('#go_btn').live('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            });
        </script>
</head>
<body>
    <div id="loading"></div>
    <div id="containerdata">
        <div class="data"></div>
        <div class="pagination"></div>
    </div>  
    
</body>
</html>