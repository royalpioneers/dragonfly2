<?php
include '../../private/conexion.php';
$pdo = DataBase::connect();
if (isset($_POST['q'])) {    
$productName = $_POST['q'];
//$lista = "select name, precio_total, hts_id from aduanet_product where name like '%".$productName."%' ;"; 
$query_pag_num = "SELECT COUNT(distinct I.id) AS count 
                    FROM
                    aduanet_importer I
                        join aduanet_dua D on
                            I.id = D.importer_id
                        join aduanet_detalledua DD on
                            DD.dua_id = D.id
                        join aduanet_product P on
                            P.id = DD.product_id
                        where P.name like '%".$productName."%';";    
    $result = $pdo->prepare($query_pag_num);
    $result->execute();
    $row = $result->fetchColumn();


$query_pag_num2 = "select count(*) from aduanet_product where name like '%".$productName."%';";    
$result2 = $pdo->prepare($query_pag_num2);
$result2->execute();
$row2 = $result2->fetchColumn();
 ?>
<section>
    <article>
        <div class="search-header">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#importer">Importer <?php echo $row; ?></a></li>                
                <li><a href="#products">Products <?php echo $row2; ?></a>
                </li>                
            </ul>
        </div>
    </article>
</section>
<section>
    <article>        
        <div class="content">
            <div class="tab-content">                
                <div class="tab-pane active" id="importer">
                    
                </div>                
                <div class="tab-pane" id="products">
                    
                </div>
            </div>        
        </div>                    
    </article>
</section>
<script type="text/javascript">
$(function () {        
    $('#myTab a').click(function (e) {
        e.preventDefault();
        variable = $(this).text();
        comparation = "Products <?php echo $row2; ?>";        
        if(variable == comparation){
            $.ajax({
                url : "public/pages/product/product_list.php",
                type : "POST",
                cache : false,
                async : true,
                data : { q: "<?php echo $productName; ?>" },
                beforeSend : function(){
                    $('#products').html("<div id='loading'> <img src='public/img/loading.gif'> </div>");
                },
                success: function(data){
                    $('#products').html(data);
                }
            });            
        }else{
            $.ajax({
                url : "public/pages/importer/importer_list.php",
                type : "POST",
                cache : false,
                async : true,
                data : { q: "<?php echo $productName; ?>" },
                beforeSend : function(){
                    $('#importer').html("<div id='loading'> <img src='public/img/loading.gif'> </div>");
                },
                success: function(datos){
                    $('#importer').html(datos);
                }
            });
        }
        $(this).tab('show');
    });
    $.ajax({
        url : "public/pages/importer/importer_list.php",
        type : "POST",
        cache : false,
        async : true,
        data : { q: "<?php echo $productName; ?>" },
        beforeSend : function(){
            $('#importer').html("<div id='loading'> <img src='public/img/loading.gif'> </div>");
        },
        success: function(datos){
            $('#importer').html(datos);
        }
    });
});
</script>
<?php
}
 ?>