<?php

namespace Model;

class Dayll
{
  protected static $db;
  
  public static function setDB($database)
  {
    self::$db = $database;
  }

  public $Id;
  public $Nombre_Diall;

  public function __construct($args = [])
  {
    $this->Id = $args['Id'] ?? null;
    $this->Nombre_Diall = $args['Nombre_Diall'] ?? '';
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
    $resultadodiasll = self::$db->query($query);

    //iterar el resultado
    $array = [];
    while ($registro = $resultadodiasll->fetch_assoc()) {
      //Se combierte a objeto
      $array[] = self::crearObjeto($registro);
    }

    //liberar memoria
    $resultadodiasll->free();

    //retornar resultado
    return $array;
  }

  public static function allDias()
  {
    $query = "SELECT * FROM dias_lugar_ll";

    $resultadodiasll = self::consultarSQL($query);

    return $resultadodiasll;
  }
}
