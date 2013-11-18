<?php 	
include '../../../private/conexion.php';
$pdo = DataBase::connect();
$idImporter = $_POST['id'];
$query = "SELECT P.id, P.name, P.precio_total, H.id as idhts, CONCAT(H.code, ' ' ,H.description) AS hts
		from  aduanet_detalledua DD 
				join aduanet_product P on
				P.id = DD.product_id
				join aduanet_dua D on
				D.id = DD.dua_id
				join aduanet_importer I on 
				I.id = D.importer_id
				join aduanet_hts H on
				H.id = P.hts_id
				where I.id = $idImporter
				group by H.id;";

$productTop = "SELECT P.name,  count(DD.product_id) as total_vendidos
				from  aduanet_detalledua DD 
				join aduanet_product P on
				P.id = DD.product_id
				join aduanet_dua D on
				D.id = DD.dua_id
				join aduanet_importer I on 
				I.id = D.importer_id
				where I.id = $idImporter
				group by DD.product_id
				order by total_vendidos	desc 
				Limit 3;
";
?>

<div class="content-principal-im">
	<div class="top-product">
		<div class="content-top-product">
			<div class="result-top">
				<b>Top Products:</b>
				<div class="name-pro">
					<table class="table">
						<thead>
							<tr>						
								<th>Name</th>
								<th>Total</th>
							
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pdo->query($productTop) as $toppro): ?>
							<tr>															
								<td class="name-top-product">
									<b><?php echo $toppro[0]; ?></b>
								</td>
								<td class="total-top-product">
									<b><?php echo $toppro[1]; ?></b>
								</td>																										
							<?php endforeach ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="contentproductimporter">		
			<div class="select-product">				
			</div>
			<div class="title-pro">
				<b> Products Importer </b>
			</div>
			<div class="load-product">
				<table class="table table-hover">
			        <thead>
			            <tr>
			                <th>Name Product</th>
			                <th>Precio Total</th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($pdo->query($query) as $value): ?>
			            <tr>
			                <td><?php echo $value['name']; ?></td>
			                <td><?php echo $value['precio_total']; ?></td>
			            </tr>
			            <?php endforeach ?>            
			        </tbody>
			    </table>
			</div>
		
	</div>
</div>
