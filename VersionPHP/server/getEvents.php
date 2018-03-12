<?php
session_start();
if ($_SESSION['isLogin']) {
	require_once('Conector.php');
	$con = new ConectorDB('localhost','facu','123456');
	$response['conexion'] =  $con->initConexion('agenda_db');

	if ($response['conexion'] == 'OK') {
		$tablas = [0 => 'eventos'];
		$campos = [0 => '*'];
		$condicion = 'WHERE usu_id = "41"'; /*id de SESSION !!!!!!!!!!!!!!!!*/
		$resultado = $con->consultar($tablas,$campos,$condicion);
		if ($resultado -> num_rows != 0) {
			$i = 0;
			while ($fila = $resultado -> fetch_assoc()) {
				$evento['id'] = $fila['id'];
				$evento['title'] = $fila['titulo'];
				if ($fila['dia_completo'] == 1) {
					$evento['start'] = $fila['fecha_inicio'];
					$evento['allDay'] = true;
				}else{
					$evento['start'] = $fila['fecha_inicio'].' '.$fila['hora_inicio']; 	
					$evento['end'] = $fila['fecha_fin'].' '.$fila['hora_fin'];
					$evento['allDay'] = false;
				}
				$evento['color'] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
				$response['eventos'][$i] = $evento;
				$i++;
			}	
		}
		$response['msg'] = 'OK';
	}else{
		$response['msg'] = 'Problemas con la conexión a la base de datos';
	}
	//header('Content-Type: application/json');	
	echo json_encode($response);
}else{
	$response['msg'] = 'Sesion no iniciada';
}
		
