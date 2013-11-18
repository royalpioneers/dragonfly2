<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Dragonfly Project</title>
    <!-- Bootstrap -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet" media="screen">    
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="public/js/jquery-1.7.2.min.js"></script>
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
            <a class="brand" href="/admin">Dragonfly Project</a>
            <!-- Everything you want hidden at 940px or less, place within here -->
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="/dragonfly05-10/">Productos</a></li>
                </ul>
                
                    <input type="text" placeholder="Search" class="search-query span2" name="q">
                
                <!-- .nav, .navbar-search, .navbar-form, etc -->
            </div>
        </div>
    </div>
</div>

<section>
    <article>
        <div class="content-product">

        </div>        
    </article>
</section>        
<!--<script src="http://code.jquery.com/jquery-latest.js"></script> -->
<script src="public/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $( function (){        
        $(".search-query").keypress(function(event){             
            if (event.which == 13) { 
                product = $('.search-query').val();                
                $.ajax({
                    url : "public/pages/panel.php",
                    type: "POST",             
                    cache : false,
                    async: true,
                    data: {q : product},
                    beforeSend: function(){
                        $('.content-product').html("<div id='loading'> <img src='public/img/loading.gif'> </div>");
                    },
                    success: function(datos){
                        $('.content-product').html(datos);                        
                    }
                });
            }
        });
    });    
</script>
</body>
</html>
