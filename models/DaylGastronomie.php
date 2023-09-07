<?php

namespace Model;

class DaylGastronomie
{
  protected static $db;
  
  public static function setDB($database)
  {
    self::$db = $database;
  }

  public $Id;
  public $Nombre_Dial;

  public function __construct($args = [])
  {
    $this->Id = $args['Id'] ?? null;
    $this->Nombre_Dial = $args['Nombre_Dial'] ?? '';
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
    $resultadodiasl = self::$db->query($query);

    //iterar el resultado
    $array = [];
    while ($registro = $resultadodiasl->fetch_assoc()) {
      //Se combierte a objeto
      $array[] = self::crearObjeto($registro);
    }

    //liberar memoria
    $resultadodiasl->free();

    //retornar resultado
    return $array;
  }

  public static function allDias()
  {
    $query = "SELECT * FROM dias_gastronomia_l";

    $resultadodiasl = self::consultarSQL($query);

    return $resultadodiasl;
  }
}
