
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Dragonfly Project</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">    
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../public/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
</head>
<body>
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="/dragonfly05-10/">Dragonfly Project</a>
            <!-- Everything you want hidden at 940px or less, place within here -->
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="/dragonfly05-10/">Productos</a></li>
                </ul>                                                
                <!-- .nav, .navbar-search, .navbar-form, etc -->
            </div>
        </div>
    </div>
</div>
Hts: <select >
    <option>1</option>
</select>
<?php
include '../../../private/conexion.php';
$pdo = DataBase::connect();  
    $codeHts = $_POST['code'];
    $query = "SELECT 
            name, precio_total
          FROM 
            aduanet_product
            limit 10;

        ";
?>
    <table class="table table-hover">
        <thead>
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
<script src="../../js/bootstrap.min.js"></script>
</body>
</html>
