<?php

namespace Model;

class DayActivity
{
  protected static $db;
  
  public static function setDB($database)
  {
    self::$db = $database;
  }

  public $Id;
  public $Nombre_Dia;

  public function __construct($args = [])
  {
    $this->Id = $args['Id'] ?? null;
    $this->Nombre_Dia = $args['Nombre_Dia'] ?? '';
  }

  protected static function crearObjeto($registro)
  {
    $objeto = new self; //self de la clase actual

    foreach ($registro as $key => $value) {
      if (property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
  }

  public static function consultarSQL($query)
  {
    //consultar la BDs
    $resultadodias = self::$db->query($query);

    //iterar el resultado
    $array = [];
    while ($registro = $resultadodias->fetch_assoc()) {
      //Se combierte a objeto
      $array[] = self::crearObjeto($registro);
    }

    //liberar memoria
    $resultadodias->free();

    //retornar resultado
    return $array;
  }

  public static function allDias()
  {
    $query = "SELECT * FROM dias_actividad";

    $resultadodias = self::consultarSQL($query);

    return $resultadodias;
  }
}
