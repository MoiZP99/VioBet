<?php

namespace Model;

class StatePlace
{
  protected static $db;

  public static function setDB($database)
  {
    self::$db = $database;
  }

  public $Id;
  public $Estado;

  public function __construct($args = [])
  {
    $this->Id = $args['Id'] ?? null;
    $this->Estado = $args['Estado'] ?? '';
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
    $resultadoestado = self::$db->query($query);

    //iterar el resultado
    $array = [];
    while ($registro = $resultadoestado->fetch_assoc()) {
      //Se combierte a objeto
      $array[] = self::crearObjeto($registro);
    }

    //liberar memoria
    $resultadoestado->free();

    //retornar resultado
    return $array;
  }

  public static function all()
  {
    $query = "SELECT Id, Estado FROM estado WHERE Estado = 'Activo' OR Estado = 'Inactivo'";

    $resultadoestado = self::consultarSQL($query);

    return $resultadoestado;
  }
  
  public static function Estado()
  {
    $query = "SELECT Id, Estado FROM estado WHERE Estado LIKE 'Solicitud'";

    $resultEstado = self::consultarSQL($query);

    return $resultEstado;
  }
}
