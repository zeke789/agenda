<?php


 require_once('Conector.php');
/*los parametros POST vienen de la funcion de submit en index.js*/
 $post_pass = isset($_POST['password']) ? $_POST['password'] : ''; 
  $post_user = isset($_POST['username']) ? $_POST['username'] : '';

$con = new ConectorDB('localhost','facu','123456');
$connect =  $con->initConexion('agenda_db');
if ($connect == 'OK') {
	$respuesta = $con->consultar(['usuarios'],['email','id','pass'],'WHERE email = "' . $post_user . '"'); 
	$filas =  $respuesta->fetch_assoc();

	if ($respuesta->num_rows == 1) {
		$hash = $filas['pass'];
		$id = $filas['id'];
		$email = $filas['email'];
		if (password_verify($post_pass,$hash) == true) {
			session_start();
			$_SESSION['id'] = $id;
			$_SESSION['isLogin'] = true;
			$response['msg'] = 'OK';
		}else{
			$response['msg'] = 'Password incorrecto';
		}		
		
	}else{
		$response['msg'] = 'No se encuentra el usuario';
	}
}else{
	$response['msg'] = 'Hubo un error al intentar conectar al servidor';
}

echo json_encode($response);

 