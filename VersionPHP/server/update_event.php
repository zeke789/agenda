<?php
session_start();
if (isset($_SESSION['isLogin'])){
	require_once 'Conector.php';			
	$id = isset($_POST['id']) ? $_POST['id'] : NULL; 
	$a = isset($_POST['start_date']) ? $_POST['start_date'] : NULL;
	$b = isset($_POST['start_hour']) ? $_POST['start_hour'] : NULL;
	$c = isset($_POST['end_date']) ? $_POST['end_date'] : NULL;
	$d = isset($_POST['end_hour']) ? $_POST['end_hour'] : NULL;

	$fecha_inicio	=date("Y/m/d",strtotime($a));
	$hora_inicio	=date("H:i:s",strtotime($b));	
	$fecha_fin	=date("Y/m/d",strtotime($c));
	$hora_fin	=date("H:i:s",strtotime($d));
	$data = [
		'fecha_inicio' => '"' . $fecha_inicio . '"',			
		'fecha_fin' => '"' . $fecha_fin . '"',
		'hora_inicio' =>'"'.$hora_inicio .'"',
		'hora_fin' => '"'.$hora_fin .'"'
	];
	$con = new ConectorDB('localhost','facu','123456');
	if ($con->initConexion('agenda_db')) {
		if ($con->actualizarRegistro('eventos',$data,' id = ' . $id)) {
			$response['msg'] = 'OK';
		}else{
				$response['msg'] = 'No se pudo actualizar';
		}
	}	
}else{
		$reponse["msg"]="Sesion no iniciada";
}
	
	
echo json_encode($response);

 ?>

 



