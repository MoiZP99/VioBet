<?php

namespace Model;

class Space
{
  protected static $db;

  public static function setDB($database)
  {
    self::$db = $database;
  }

  public $Id;
  public $Espacio;

  public function __construct($args = [])
  {
    $this->Id = $args['Id'] ?? null;
    $this->Espacio = $args['Espacio'] ?? '';
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
    $resultadoespacio = self::$db->query($query);

    //iterar el resultado
    $array = [];
    while ($registro = $resultadoespacio->fetch_assoc()) {
      //Se combierte a objeto
      $array[] = self::crearObjeto($registro);
    }

    //liberar memoria
    $resultadoespacio->free();

    //retornar resultado
    return $array;
  }

  public static function allTipoEspacio()
  {
    $query = "SELECT * FROM tipo_espacio";

    $resultadoespacio = self::consultarSQL($query);

    return $resultadoespacio;
  }
}
