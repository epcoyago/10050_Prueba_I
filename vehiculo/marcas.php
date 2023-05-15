<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Matriculas Vehículos</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body style="background-image: url('images/fondo.jpg');  background-repeat:no-repeat; background-size: 95rem;">
	<div class="container text-center" style="margin-top:5%;">
		<br>
        <img id="Espe_img" class="" src="img/logo_ESPE.png" style="position:absolute;left:350px;top:40px;width:500px;height:89px;">
		<br>
	</div>
		
	<div class="container">
	
	<?php
		require_once("constantes.php");
		include_once("class/class.marca.php");
		
		$cn = conectar();
		$v = new marca($cn);
		
		if(isset($_GET['d'])){
			$dato = base64_decode($_GET['d']);
		//	echo $dato;exit;
			$tmp = explode("/", $dato);
			$dato = $_GET['d'];
			$op = $tmp[0];
			$id = $tmp[1];
			
			if($op == "del"){
				echo $v->delete_marca($id);
			}elseif($op == "det"){
				echo $v->get_detail_marca($id);
			}elseif($op == "new"){
				echo $v->get_form_marca();
			}elseif($op == "act"){
				echo $v->get_form_marca($id);
			}
			
       // PARTE III	
		}else{
			   /* echo "<br>PETICION POST <br>";
				echo "<pre>";
					print_r($_POST);
				echo "</pre>"; */
		
			if(isset($_POST['Guardar']) && $_POST['op']=="new"){
				$v->save_marca($_POST);
			}elseif(isset($_POST['Guardar']) && $_POST['op']=="act"){
				$v->update_marca($_POST);
			}else{
				echo $v->get_list($_POST);
			}	
		}
		
	//*******************************************************
		function conectar(){
			//echo "<br> CONEXION A LA BASE DE DATOS<br>";
			$c = new mysqli(SERVER,USER,PASS,BD);
			
			if($c->connect_errno) {
				die("Error de conexión: " . $c->mysqli_connect_errno() . ", " . $c->connect_error());
			}else{
				//echo "La conexión tuvo éxito .......<br><br>";
			}
			
			$c->set_charset("utf8");
			return $c;
		}
	//**********************************************************	

		
	?>	
</body>
</html>
