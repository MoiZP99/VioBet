<?php

namespace Model;

class DtCruce
{
  protected static $db;
  protected static $columnasDB = ['IdDatosCruce', 'Raza', 'Pureza'];

  public static $errores;
  public static $ErrRaza;
  public static $ErrPureza;

  public $IdDatosCruce;
  public $Raza;
  public $Pureza;

  public function __construct($args = [])
  {
    $this->IdDatosCruce = $args['IdDatosCruce'] ?? null;
    $this->Raza = $args['Raza'] ?? '';
    $this->Pureza = $args['Pureza'] ?? '';
  }

  public static function setDB($database)
  {
    self::$db = $database;
  }

  public function guardar()
  {
    if (!is_null($this->IdDatosCruce)) {
      $this->actualizar();
    } else {
      $this->crear();
    }
  }

  public function sincronizar($args = [])
  {
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  public function crear()
  {
    $atributos = $this->sanitizarAtributos();

    $query = " INSERT INTO datoscruce ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' ";
    $query .= join("', '", array_values($atributos));
    $query .= " ') ";

    $resultado = self::$db->query($query);

    return $resultado;
  }


  public function actualizar()
  {
    $atributos = $this->sanitizarAtributos();

    $valores = [];
    foreach ($atributos as $key => $value) {
      $valores[] = "{$key}='{$value}'";
    }

    $query = "UPDATE datoscruce SET ";
    $query .=  join(', ', $valores);
    $query .= " WHERE IdDatosCruce = '" . self::$db->escape_string($this->IdDatosCruce) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }

  public function atributos()
  {
    $atributos = [];
    foreach (self::$columnasDB as $columna) {
      if ($columna === 'IdDatosCruce') continue;
      $atributos[$columna] = $this->$columna;
    }

    return $atributos;
  }

  public function sanitizarAtributos()
  {
    $atributos = $this->atributos();

    $sanitizado = [];

    foreach ($atributos as $key => $value) {
      $sanitizado[$key] = self::$db->escape_string($value);
    }

    return $sanitizado;
  }

  public function eliminar()
  {
    $query = "DELETE FROM datoscruce WHERE IdDatosCruce = " . self::$db->escape_string($this->IdDatosCruce) . " LIMIT 1";
    $resultado = self::$db->query($query);

    return $resultado;
  }

  public static function getErrores()
  {
    return self::$errores;
  }

  public static function getErrRaza()
  {
    return self::$ErrRaza;
  }

  public static function getErrPureza()
  {
    return self::$ErrPureza;
  }

  public function validaRaza()
  {
    if (!($this->Raza)) {
      self::$ErrRaza = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrRaza;
  }
  
  public function validaPureza()
  {
    if (!($this->Pureza)) {
      self::$ErrPureza = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrPureza;
  }

  public function validar()
  {
    if ((!$this->Raza) || (!$this->Pureza)) {
      self::$errores = '<strong>Advertencia!</strong> Verifique que los datos ingresados sean correctos.';
    }

    return self::$errores;
  }


  protected static function crearObjeto($registro)
  {
    $objeto = new self;

    foreach ($registro as $key => $value) {
      if (property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
  }


  public static function consultarSQL($query)
  {
    $resultado = self::$db->query($query);

    $array = [];
    while ($registro = $resultado->fetch_assoc()) {
      $array[] = self::crearObjeto($registro);
    }

    $resultado->free();

    return $array;
  }

  public static function all()
  {
    $query = "SELECT DISTINCT IdDatosCruce, Raza, Pureza FROM datoscruce";
              

    $resultado = self::consultarSQL($query);

    return $resultado;
  }
}
