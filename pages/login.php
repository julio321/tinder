<?php
    if(isset($_SESSION['login'])){
   		header('Location: '.INCLUDE_PATH.'home');


    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logar no Sistema</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		form{
			max-width: 800px;
			padding: 10px;
			width: 100%;
			border:2px solid rgb(230,230,230);
			border-radius: 10px;
			position: absolute;
			left: 50%;
			top: 50%;
			transform:translate(-50%,-50%);
		}

		input[type=text],
		input[type=password]{
			width: 100%;
			height: 40px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			padding-left: 15px;
		}

		input[type=submit]{
			width: 70%;
			height: 30px;
			border-radius: 20px;
			background: #e82975;
			color: white;
			font-size: 22px;
			border: 0;
			display: block;
			cursor: pointer;
			margin: 0 auto;
		}

	</style>
</head>
<body>

<?php
   if(isset($_POST['acao'])){
   	if(Usuarios::verificarLogin($_POST['login'],$_POST['senha'])){
   		$getId = Usuarios::getUserId($_POST['login']);
   		Usuarios::startSession($_POST['login'],$getId);
   		header('Location: '.INCLUDE_PATH.'home');
        
   	}else{
   		header('Location: '.INCLUDE_PATH.'login');
   	}
   }
?>

<form method="post">
    <h2>login:</h2>
    <br />
    <input type="text" name="login">
    <input type="password" name="senha">
    <input type="submit" name="acao" value="logar!">
</form>

</body>
</html>