<?php
session_start();
if (isset($_SESSION['isLogin'])) {
	require_once('Conector.php');
	 $session_usu_id = 41;
	 $title = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;
	 $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : NULL;
	 $start_hour = isset($_POST['start_hour']) ? $_POST['start_hour'] : NULL;
	 $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : NULL;
	 $end_hour = isset($_POST['end_hour']) ? $_POST['end_hour'] : NULL;
	 $allDay = isset($_POST['allDay']) ? $_POST['allDay'] : '';
 		

	$con = new ConectorDB('localhost','facu',123456);
	 
	if ($con->initConexion('agenda_db')) {		
		
		$datos = [
			'usu_id' => '"' .$session_usu_id. '"',
			'titulo' => '"' . $title . '"',
			'fecha_inicio' => '"' . $start_date . '"',
			'dia_completo' => $allDay,
			'fecha_fin' => '"' . $end_date . '"',
			'hora_inicio' =>'"'.$start_hour .'"',
			'hora_fin' => '"'.$end_hour .'"'
		];

		if ($con->insertData('eventos',$datos)) {
			$response['msg'] = 'OK';
			$response['allDay'] = $allDay;					
			echo json_encode($response);
		}else {
			$response['msg'] = 'El evento no pudo ser agregado';	
			echo json_encode($response);
		}
	}





	/**********vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv******************* 
		
	 PARA QE FUNCIONE EL ANTERIOR CODIGO, CAMBIAR FUNCION AñadirEvento() EN app.js a:

	 var a = document.getElementById('allDay').checked;      
      if (a === true) {
        form_data.append('allDay', 1)
      }else{form_data.append('allDay', 0)} 

      -------vvv-------OTRO CODIGO QUE NO FUNCIONABA.´´ ------vvvv------
      *****otro codigo: ***vvvvvvvvvvvvvvvvvvvvvvvvvvv***********/


	 	/*	

		//PRUEBA QUE SIEMPRE TOMA A $allDay como TRUE		

 		if ($allDay == true) {
 			$response['msg'] = 'OK';
 		 	$response['dias'] = $allDay;
 		 	echo json_encode($response);
 		}else{
 			$response['dias'] = 'allDay no es TRUE!!!';
 			echo json_encode($response);
 		}
 		 		
 	 	if ($allDay == true) {
 	 	  	$allDay = 1; 
 	 	  }elseif($allDay == false){
 	 	  	$allDay = 0;
 	 	  }  
 		// DE ACA PARA ABAJO COMENTAR TODO EL CODIGO PARA Q FUNCIONE LO D ARRIBA
		
		*/


/*
		if ($allDay == true) {
			$variable = 1;
		}else{
			$variable=0;
		}		
		if ($variable === 1) {
 
			if (!empty($title) && !empty($start_date) && $variable === 1) {
				if($con->insertData('eventos',$datos)){					
					$response['msg'] = 'OK';					
					echo json_encode($response);
				}else {
					$response['msg'] = 'El evento no pudo ser agregado';	
					echo json_encode($response);
				}
			}		
		}else{
			$response['msg'] = 'all day es false';	
					echo json_encode($response);
		}

	}else{
		$response['msg'] = 'Hubo un problema al intentar conectarse al servidor';
	}

	*/

	/****** falta hacer insert para eventos que no son dia completo ******/

	
}