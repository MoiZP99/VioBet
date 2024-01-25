<?php

namespace Model;

class Finca
{
  protected static $db;
  protected static $columnasDB = ['IdFinca', 'NombreFinca' ,'Ubicacion', 'Tamano', 'FKUsuario'];

  public static $errores;
  public static $ErrNomb;
  public static $ErrUbi;
  public static $ErrTama;
  public static $ErrFKFinca;
  public static $ErrFKUsuario;

  public $IdFinca;
  public $NombreFinca;
  public $Tamano;
  public $Ubicacion;
  public $FKUsuario;
  public $NombreUser; //join


  public function __construct($args = [])
  {
    $this->IdFinca = $args['IdFinca'] ?? null;
    $this->NombreFinca = $args['NombreFinca'] ?? '';
    $this->Ubicacion = $args['Ubicacion'] ?? '';
    $this->Tamano = $args['Tamano'] ?? '';
    $this->FKUsuario = $args['FKUsuario'] ?? '';
  }

  public static function setDB($database)
  {
    self::$db = $database;
  }

  public function guardar()
  {
    if (!is_null($this->IdFinca)) {
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

    $query = " INSERT INTO finca ( ";
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

    $query = "UPDATE finca SET ";
    $query .=  join(', ', $valores);
    $query .= " WHERE IdFinca = '" . self::$db->escape_string($this->IdFinca) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }


  public static function get($limite)
  {
    $query = "SELECT DISTINCT IdAnimal, NombreFinca, Ubicacion, Tamano, FKUsuario
              FROM finca
              LIMIT $limite";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public function atributos()
  {
    $atributos = [];
    foreach (self::$columnasDB as $columna) {
      if ($columna === 'IdFinca') continue;
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
    $query = "DELETE FROM finca WHERE IdFinca = " . self::$db->escape_string($this->IdFinca) . " LIMIT 1";
    $resultado = self::$db->query($query);

    return $resultado;
  }

  public static function getErrores()
  {
    return self::$errores;
  }

  public static function getErrNomb()
  {
    return self::$ErrNomb;
  }

  public static function getErrUbi()
  {
    return self::$ErrUbi;
  }

  public static function getErrTama()
  {
    return self::$ErrTama;
  }

  public static function getErrFKUsuario()
  {
    return self::$ErrFKUsuario;
  }

  public function validaNombre()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->NombreFinca)) {
      self::$ErrNomb = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->NombreFinca)) {
      self::$ErrNomb = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrNomb;
  }

  public function validaUbi()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Ubicacion)) {
      self::$ErrUbi = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Ubicacion)) {
      self::$ErrUbi = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrUbi;
  }

  public function validaTama()
  {
    if (!preg_match("/^\d*\.?\d+$/", $this->Tamano)) {
      self::$ErrTama = '<div style="padding-inline: 12px;"><strong>Error!</strong> números son permitidos.</div>';
    } elseif (empty($this->Tamano)) {
      self::$ErrTama = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrTama;
  }

  public function validaFKUsuario()
  {
    if (empty($this->FKUsuario)) {
      self::$ErrFKUsuario = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrFKUsuario;
  }

  public function validar()
  {
    if ((!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->NombreFinca)) ||
        (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Ubicacion)) ||
        (!preg_match("/^\d*\.?\d+$/", $this->Tamano)) ||
        (!$this->FKUsuario)
    ) {
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
    $idUsuarioSesion = $_SESSION['idUsuario'];
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              WHERE FKUsuario = $idUsuarioSesion";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public static function innerJoin()
  {
    $idUsuarioSesion = $_SESSION['idUsuario'];
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              WHERE FKUsuario = $idUsuarioSesion";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }
  
  public static function find($IdFinca)
  {
    $query = "SELECT DISTINCT IdFinca, NombreFinca, Ubicacion, Tamano, FKUsuario
              FROM finca 
              WHERE IdFinca = $IdFinca";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }
  public static function contar(){
    $idUsuarioSesion = $_SESSION['idUsuario'];
    // $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser
    //           FROM finca f
    //           INNER JOIN Usuario u
    //           ON f.FKUsuario = u.IdUsuario
    //           WHERE FKUsuario = $idUsuarioSesion";
              
    $query = "SELECT * FROM finca WHERE FKUsuario = $idUsuarioSesion";
    $resultado = self::$db->query($query);
    $numero_de_registros = mysqli_num_rows($resultado);
    return $numero_de_registros;
    // echo $numero_de_registros;
    // die();
  }
}
