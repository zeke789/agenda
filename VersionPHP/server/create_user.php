<?php
require_once('Conector.php');

$con = new ConectorDB('localhost','facu','123456');

$con->initConexion('agenda_db');
/*ATENCION CON LAS COMILLAS, PARA QUE SE GENERE BIEN EL SQL*/
$hash1 = '"'.password_hash('123456', PASSWORD_DEFAULT).'"';
$hash2 = '"'.password_hash('123456', PASSWORD_DEFAULT).'"';
$hash3 = '"' . password_hash('123456', PASSWORD_DEFAULT) . '"';

$data = [
	0 =>[
		'nombre'=>"'facu'",
		'email'=>"'facu@miemail.com'",
		'fecha_nacimiento'=>"'02/10/1990'",
		'pass'=> $hash1
	],
	1 =>[
		'nombre'=>"'pepe'",
		'email'=>"'pepe@miemail.com'",
		'fecha_nacimiento'=>"'05/12/1990'",
		'pass'=> $hash2
	],
	2 =>[
		'nombre'=>"'jose'",
		'email'=>"'jose@miemail.com'",
		'fecha_nacimiento'=>"'10/05/1990'",
		'pass'=> $hash3
	]
];

 
$i = 0;

for ($i=0; $i < 3 ; $i++) { 
	if ($con->insertData('usuarios',$data[$i])) {
		echo 'Usuario  agregado' . '<br/>';
	}else{
		echo ' error' . '<br/>';
	}
}
 

 ?>
 <a href="../client/index.html">Ir al index</a>

<?php

 
$con->cerrarConexion();





 ?>
