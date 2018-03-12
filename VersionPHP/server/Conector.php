<?php

class ConectorDB
  {
    private $host;
    private $user;
    private $password;
    private $conexion;

    function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }

    function initConexion($nombre_db){
      $this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
      if ($this->conexion->connect_error) {
        return "Error:" . $this->conexion->connect_error;
      }else {
        return "OK";
      }
    }

    function ejecutarQuery($query){
      return $this->conexion->query($query);


    /*  if ($asd = $this->conexion->query($query)) {
          return $asd;
      }else{
        throw New PDOException('-- PROBLEMA EN FUNCION ejecutarQuery()!! --');
      }*/
    }

    function cerrarConexion(){
      $this->conexion->close();
    }

    function nuevaRelacion($from_tbl, $to_tbl, $from_field, $to_field){
      $sql = 'ALTER TABLE '.$from_tbl.' ADD FOREIGN KEY ('.$from_field.') REFERENCES '.$to_tbl.'('.$to_field.');';
      return $this->ejecutarQuery($sql);
    }



    function insertData($tabla, $data){$sql = 'INSERT INTO '.$tabla.' (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ')';
        $i++;
      }
      $sql .= ' VALUES (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $value;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ');';
        $i++;
      }
      
       return $this->ejecutarQuery($sql);
           
    }

    function getConexion(){
      return $this->conexion;
    }

    function actualizarRegistro($tabla, $data, $condicion){
      $sql = 'UPDATE '.$tabla.' SET ';
      $i=1;
      foreach ($data as $key => $value) {
        $sql .= $key.'='.$value;
        if ($i<sizeof($data)) {
          $sql .= ', ';
        }else $sql .= ' WHERE '.$condicion.';';
        $i++;
      }
      return $this->ejecutarQuery($sql);
    }

    function eliminarRegistro($tabla, $condicion){
      $sql = "DELETE FROM ".$tabla." WHERE ".$condicion.";";
      return $this->ejecutarQuery($sql);
    }

    function consultar($tablas, $campos, $condicion = ""){
      $sql = "SELECT ";
      $arrayk = array_keys($campos);
      $ultima_key = end($arrayk);
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }
      $arrayk2 = array_keys($tablas);
      $ultima_key = end($arrayk2);
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }

      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }

       return $this->ejecutarQuery($sql);
      
    }

     function consultaCompuesta($tablas, $campos, $relaciones, $condicion = ""){
      $sql = "SELECT ";

      $keys = array_keys($campos);
      $ultima_key = end($keys);  

      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }
      $sql .= $tablas[0]." ";

       $keys = array_keys($tablas);
      $ultima_key = end($keys);

      foreach ($tablas as $key => $value) {
        if ($key != 0) { //si la key no es igual a 0 es porque se volvio a recorrer un bucle osea q hay mas de 1 tabla
          $sql .= "JOIN ".$value." ON ".$relaciones[$key-1]." \n";
        }
      }
      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
     return $this->ejecutarQuery($sql);

      //echo $sql;
    }


  } 