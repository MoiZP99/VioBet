<?php

namespace Model;

class Finca
{
  protected static $db;
  protected static $columnasDB = ['IdFinca', 'Nombre' ,'Ubicacion', 'Tamano'];

  public static $errores;
  public static $ErrNomb;
  public static $ErrUbi;
  public static $ErrTama;
  public static $ErrFKFinca;

  public $IdFinca;
  public $Nombre;
  public $Tamano;
  public $Ubicacion;
  public $FKFinca;

  public function __construct($args = [])
  {
    $this->IdFinca = $args['IdFinca'] ?? null;
    $this->Nombre = $args['Nombre'] ?? '';
    $this->Ubicacion = $args['Ubicacion'] ?? '';
    $this->Tamano = $args['Tamano'] ?? '';
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
    $query = "SELECT DISTINCT IdAnimal, Nombre, Ubicacion, Tamano
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

  public static function getErrFKFinca()
  {
    return self::$ErrFKFinca;
  }

  public function validaNombre()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre)) {
      self::$ErrNomb = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Nombre)) {
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
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Tamano)) {
      self::$ErrTama = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Tamano)) {
      self::$ErrTama = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrTama;
  }

  public function validaFinca()
  {
    if (empty($this->FKFinca)) {
      self::$ErrFKFinca = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrFKFinca;
  }

  public function validar()
  {
    if ((!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre)) ||
        (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Ubicacion)) ||
        (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Tamano)) ||
        (!$this->FKFinca)
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

  // public static function all()
  // {
  //   $query = "SELECT lt.Id, lt.Nombre_Lugar, lt.Numero_Contacto, lt.Descripcion, lt.Correo, lt.Imagen, 
  //             lt.TipoEspacio_Id, lt.Hora_apertura, lt.Hora_clausura, lt.Ubicacion, lt.categoria_Id, 
  //             lt.DiaApertura_Id, lt.DiaClausura_Id
  //             FROM lugar_turistico lt";

  //   $resultado = self::consultarSQL($query);

  //   return $resultado;
  // }

  public static function innerJoin()
  {
    $query = "SELECT DISTINCT f.IdFinca, f.Nombre, f.Ubicacion, f.Tamano
              FROM finca f";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public static function innerPDF()
  {
    $opcion = isset($_POST['opcion']) ? $_POST['opcion'] : 'todo';

    $query = "SELECT DISTINCT lt.Id, lt.Nombre_Lugar, lt.Numero_Contacto, lt.Correo,
              te.Espacio, lt.Ubicacion, cl.categoria_turismo, e.Estado
              FROM lugar_turistico lt
              INNER JOIN tipo_espacio te
              ON lt.TipoEspacio_Id = te.Id
              INNER JOIN categoria_lugar cl
              ON lt.categoria_Id = cl.Id
              INNER JOIN estado e
              ON lt.FK_Estado = e.Id";

    if ($opcion === 'activo') {
      $query .= " WHERE e.Estado = 'Activo'";
    } elseif ($opcion === 'inactivo') {
      $query .= " WHERE e.Estado = 'Inactivo'";
    } elseif ($opcion === 'todo') {
      $query .= " WHERE e.Estado = 'Activo' OR e.Estado = 'Inactivo'";
    }

    $reportPDF = self::consultarSQL($query);

    return $reportPDF;
  }
  
  public static function find($Id)
  {
    $query = "SELECT DISTINCT IdFinca, Nombre, Ubicacion, Tamano
              FROM finca 
              WHERE IdFinca = $Id";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }
}
