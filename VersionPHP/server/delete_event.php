<?php
	require_once "Conector.php";
	session_start();		
		if (isset($_SESSION['isLogin'])){
			$con = new ConectorDB('127.0.0.1','facu',123456);
			if ($con->initConexion('agenda_db')) {
				if (isset($_POST["id"]) && is_numeric($_POST["id"]))  {
					$id = $_POST["id"];
					if ($con->eliminarRegistro('eventos', 'id = ' .$id)) {
						$php_reponse["msg"]="OK";	
						echo json_encode($php_reponse);					 
					}
				}

			}else{
				$response['msg'] = 'Error al intentar conectar a la database';
				echo json_encode($php_reponse);
			}					
		}else{
			$php_reponse["msg"]="La sesion no existe ";
			echo json_encode($php_reponse);
		}
	
	
	

