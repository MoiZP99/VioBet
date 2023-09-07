<?php

namespace Model;

class Fair_Entrepreneur
{
  protected static $db;
  
  public static function setDB($database)
  {
    self::$db = $database;
  }

  public $Id;
  public $NombFeriaEmprende;

  public function __construct($args = [])
  {
    $this->Id = $args['Id'] ?? null;
    $this->NombFeriaEmprende = $args['NombFeriaEmprende'] ?? '';
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
    $resultFeriaEmprende = self::$db->query($query);

    //iterar el resultado
    $array = [];
    while ($registro = $resultFeriaEmprende->fetch_assoc()) {
      //Se combierte a objeto
      $array[] = self::crearObjeto($registro);
    }

    //liberar memoria
    $resultFeriaEmprende->free();

    //retornar resultado
    return $array;
  }

  public static function all()
  {
    $query = "SELECT Id, NombFeriaEmprende FROM feria_y_emprendedor";

    $resultFeriaEmprende = self::consultarSQL($query);

    return $resultFeriaEmprende;
  }
}
