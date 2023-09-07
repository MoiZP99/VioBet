<?php

namespace Model;

class Age
{
  protected static $db;
  
  public static function setDB($database)
  {
    self::$db = $database;
  }

  public $Id;
  public $Edad;

  public function __construct($args = [])
  {
    $this->Id = $args['Id'] ?? null;
    $this->Edad = $args['Edad'] ?? '';
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
    $resultadoedad = self::$db->query($query);

    //iterar el resultado
    $array = [];
    while ($registro = $resultadoedad->fetch_assoc()) {
      //Se combierte a objeto
      $array[] = self::crearObjeto($registro);
    }

    //liberar memoria
    $resultadoedad->free();

    //retornar resultado
    return $array;
  }

  public static function all()
  {
    $query = "SELECT * FROM edad";

    $resultadoedad = self::consultarSQL($query);

    return $resultadoedad;
  }
}
