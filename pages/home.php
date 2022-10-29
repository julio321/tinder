<?php
   if(isset($_GET['deslogar'])){
   	Usuarios::deslogar();
   	header('Location:'.INCLUDE_PATH);
   }

if(isset($_GET['action'])){
$action = $_GET['action'];
if($action == ACTION_LIKE){
         Usuarios::executarAcao(ACTION_LIKE,$_GET['id']);
 }else if($action == ACTION_DISLIKE){
        Usuarios::executarAcao(ACTION_DISLIKE,$_GET['id']);


    		    	}
    		    }   
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bem-vindo(a) <?php echo $_SESSION['nome'] ?></title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		html,body{
			height: 100%;
		}
		.sidebar{
			width: 300px;
			height: 100%;
			float: left;
			background: rgb(230,230,230);
		}
		.topo{
			padding: 10px;
			background: #e82975;
			color: white;
		}
		.topo a{
            color: white;
		}
		.btn-coord{text-align: center;}
		.btn-coord button{
			margin-top: 10px;
			background: #e82975;
			padding: 8px 10px;
			color: white;
			font-weight: bold;
			border: 0;
			cursor: pointer;
			text-decoration: none;
			display: inline-block;
		}
		.info-localizacao{
			padding: 10px;
		}
		.box-usuario-like{
			position: absolute;
			left: 50%;
			top: 50%;
			transform:translate(-50%,-50%); 
			width: 400px;
			height: 400px;
			background: rgb(230,230,230);
			line-height: 400px;
			text-align: center;
		}
	</style>
</head>
<body>

	<div class="sidebar">
		<div class="topo">
			<h3>Bem-vindo(a) <?php echo $_SESSION['nome'] ?> | <a href="<?php echo INCLUDE_PATH ?>?deslogar">Deslogar!</a></h3>
	 </div>
	 <div class="btn-coord">
			<button onclick="getLocation()">Atualizar Coodenadas!</button>
	 </div>
	 <div id="localizacao" class="info-localizacao">
	 	<p class="lat-text">Latitude: <?php echo $_SESSION['latitude'] ?></p>
	 	<p class="long-text">Longitude: <?php echo $_SESSION['longitude'] ?> </p>
	 	<p>Localização: <?php echo $_SESSION['localizacao']; ?></p>
	 	<h3>Seus crushs:</h3>
	 	<ul>
	 		<?php
	 		    $crushs = Usuarios::pegaCrushs();
	 		    foreach ($crushs as $key => $value) {
	 		    	
	 		    
	 		?>
	 		   

	 		    <li><?php echo $value['nome'] ?> | <span style="display: none;" class="lat-user"><?php echo $value['latitude'] ?></span>
	 		    <span style="display: none;" class="long-user"><?php echo $value['longitude'] ?></span> Distância: <span class="user-distancia"></span></li>
	 	<?php } ?>
	 	</ul>

	 	
	 </div>		
    </div>

    <div class="box-usuario-like">
    	<div class="box-usuario-nome">

    		<?php
    		    
    		   $usuario  = Usuarios::pegaUsuarioNovo();
    		?>
    		<h2><?php echo $usuario['nome']; ?>
    		<a href="?action=1&id=<?php echo $usuario['id']; ?>">Gostei!</a>
    		<a href="?action=0&id=<?php echo $usuario['id']; ?>">Não Gostei!</a>
    			
    		</h2>
    		

               
    		

    	</div>
    </div><!--box-usuario-like-->	

    

    <script src=" https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    

    function getLocation(){
    	if(navigator.geolocation){
    		navigator.geolocation.getCurrentPosition(showPosition);
    	} 
    }

    function showPosition(position){
       $('p.lat-text').html('Latitude: '+ position.coords.latitude);
       $('p.long-text').html('Longitude: '+ position.coords.longitude);

        //Pssando via ajax para atualizar  o banco
     atualizarCoordenadas(position.coords.latitude,position.coords.longitude);
    } 

    function atualizarCoordenadas(latitudePar,longitudePar){
    	 $.ajax({
    	url:'/teste/tinder/atualizar-coord.php',
    	method:'post',
    	data:{latitude:latitudePar,longitude:longitudePar}
     }).done(function(){
     	alert('Atualizado com sucesso!');
     })

    }	


    	
    	
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(function(){

    $('li').each(function(){	
    	var latitude = $(this).find('.lat-user').html();
    	var longitude = $(this).find('.long-user').html();
    	console.log(latitude);
    	console.log(longitude);
    })



    })	
    $(function(){
    	alert('bucetada!');
    	function getDistanceFromLatLonInkm(lat1,lon1,lat2,lon2){
    	var R = 6371;
    	var dlat = deg2rad(lat2-lat1);
    	var dlon = deg2rad(lon2-lon1);
    	var a =

    	  Math.sin(dlat/2) * Math.sin(dlat/2)+
    	  Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
    	  Math.sin(dlon/2) * Math.sin(dlon/2)

    	  ;
    	  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    	  var d = R * c;
    	  return d;

    }
    })	
    	
    	
    </script>
</body>
</html>