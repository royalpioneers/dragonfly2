<?php
include '../../../private/conexion.php';
$pdo = DataBase::connect();
if($_POST['page'] and $_POST['q'])
{
	$page = $_POST['page'];
	$productName = $_POST['q'];
	$cur_page = $page;
	$page -= 1;
	$per_page = 15;
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	$start = $page * $per_page;	
	$lista_importer = "select
                    distinct I.id as code, I.name as name_importer
                from 
                    aduanet_importer I
                join aduanet_dua D on
                    I.id = D.importer_id
                join aduanet_detalledua DD on
                    DD.dua_id = D.id
                join aduanet_product P on
                    P.id = DD.product_id
                where P.name like '%".$productName."%' LIMIT $start, $per_page;";
?>
	<!-- ***** Data Importer ***** -->
	<div class="data">
		<?php
            $i=0;
            foreach($pdo->query($lista_importer) as $row){
                $i = $i + 1;
        ?>
            <div class="search-importer-result">
                <div class="search-item-importer">                           
                    <h5><a href="importer"><?php echo $i. "   ". $row['name_importer']; ?></a></h5>
                </div>
            </div>                            
        <?php }?>

	</div>
	<!-- ***** End Importer ***** -->
	<?php
	$query_pag_num = "SELECT COUNT(distinct I.id , I.name) AS count 
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
    $count = $row;
    $no_of_paginations = ceil($count / $per_page);
	if ($cur_page >= 7) {
	    $start_loop = $cur_page - 3;
	    if ($no_of_paginations > $cur_page + 3)
	        $end_loop = $cur_page + 3;
	    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
	        $start_loop = $no_of_paginations - 6;
	        $end_loop = $no_of_paginations;
	    } else {
	        $end_loop = $no_of_paginations;
	    }
	}else {
	    $start_loop = 1;
	    if ($no_of_paginations > 7){
	        $end_loop = 7;
	    }else{
	        $end_loop = $no_of_paginations;
	    }
	}
	?>
	<div class='pagination'>
		<ul>
			<?php
			// FOR ENABLING THE FIRST BUTTON
			if ($first_btn && $cur_page > 1) {
			?>
		    	<li p='1' class='active'>First</li>
			<?php
			} else if ($first_btn) {
			?>
		    	<li p='1' class='inactive'>First</li>
			<?php
			}
			// FOR ENABLING THE PREVIOUS BUTTON
			if ($previous_btn && $cur_page > 1) {
			    $pre = $cur_page - 1;
			?>
			   	<li p='<?php echo $pre; ?>' class='active'>Previous</li>
			<?php
			} else if ($previous_btn) {
			?>
			    <li class='inactive'>Previous</li>
			<?php
			}
			for ($i = $start_loop; $i <= $end_loop; $i++) {
	    		if ($cur_page == $i){
			?>
	        		<li p='<?php echo $i; ?>' style='color:#fff;background-color:#006699;' class='active'><?php echo $i; ?></li>
				<?
				}else{
	        	?>
	        		<li p='<?php echo $i; ?>' class='active'><?php echo $i; ?></li>
				<?php
				}
			}	
			// TO ENABLE THE NEXT BUTTON
			if ($next_btn && $cur_page < $no_of_paginations) {
		    	$nex = $cur_page + 1;
			?>
		    	<li p='<?php echo $nex; ?>' class='active'>Next</li>
			<?
			} else if ($next_btn) {
			?>
		    	<li class='inactive'>Next</li>
			<?php
			}
			// TO ENABLE THE END BUTTON
			if ($last_btn && $cur_page < $no_of_paginations) {
			?>
			    <li p='<?php echo $no_of_paginations; ?>' class='active'>Last</li>
			<?php
			} else if ($last_btn) {
			?>
	    		<li p='<?php echo $no_of_paginations; ?>' class='inactive'>Last</li>			
		<?php
			}
		?>			
		</ul>		
		<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/>
		<input type='button' id='go_btn' class='go_button' value='Go'/>
		<span class='total' a='<?php echo $no_of_paginations; ?>'>Page <b><?php echo $cur_page; ?> </b> of <b><?php echo $no_of_paginations ;?></b></span>
	</div>					
<?php 
}
?>