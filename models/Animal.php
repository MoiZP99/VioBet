<?php

namespace Model;

class Animal
{
  protected static $db;
  protected static $columnasDB = ['IdAnimal', 'Nombre', 'Tipo', 'Raza', 'Edad', 'Sexo', 'Peso'];

  public static $errores;
  public static $ErrNomb;
  public static $ErrTipo;
  public static $ErrRaza;
  public static $ErrEdad;
  public static $ErrSexo;
  public static $ErrPeso;
  public static $ErrFKFinca;

  public $IdAnimal;
  public $Nombre;
  public $Tipo;
  public $Raza;
  public $Sexo;
  public $Edad;
  public $Peso;
  public $FKFinca;

  public function __construct($args = [])
  {
    $this->IdAnimal = $args['IdAnimal'] ?? null;
    $this->Nombre = $args['Nombre'] ?? '';
    $this->Tipo = $args['Tipo'] ?? '';
    $this->Raza = $args['Raza'] ?? '';
    $this->Sexo = $args['Sexo'] ?? '';
    $this->Peso = $args['Peso'] ?? '';
  }

  public static function setDB($database)
  {
    self::$db = $database;
  }

  public function guardar()
  {
    if (!is_null($this->IdAnimal)) {
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

    $query = " INSERT INTO animal ( ";
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

    $query = "UPDATE animal SET ";
    $query .=  join(', ', $valores);
    $query .= " WHERE Id = '" . self::$db->escape_string($this->IdAnimal) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }


  // public static function get($limite)
  // {
  //   $query = "SELECT DISTINCT Id, Nombre_Lugar, Numero_Contacto, Descripcion, Correo, Imagen, 
  //             Hora_apertura, Hora_clausura, Ubicacion, FK_Estado
  //             FROM lugar_turistico
  //             WHERE FK_Estado = 1
  //             LIMIT $limite";

  //   $resultado = self::consultarSQL($query);

  //   return $resultado;
  // }

  public function atributos()
  {
    $atributos = [];
    foreach (self::$columnasDB as $columna) {
      if ($columna === 'IdAnimal') continue;
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
    $query = "DELETE FROM animal WHERE IdAnimal = " . self::$db->escape_string($this->IdAnimal) . " LIMIT 1";
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

  public static function getErrTipo()
  {
    return self::$ErrTipo;
  }

  public static function getErrRaza()
  {
    return self::$ErrRaza;
  }

  public static function getErrEdad()
  {
    return self::$ErrEdad;
  }

  public static function getErrSexo()
  {
    return self::$ErrSexo;
  }

  public static function getErrPeso()
  {
    return self::$ErrPeso;
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

  public function validaTipo()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Tipo)) {
      self::$ErrTipo = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Tipo)) {
      self::$ErrTipo = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrTipo;
  }

  public function validaRaza()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Raza)) {
      self::$ErrRaza = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Raza)) {
      self::$ErrRaza = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrRaza;
  }

  public function validaEdad()
  {
    if (!preg_match("/^([0-9])*$/", $this->Edad)) {
      self::$ErrEdad = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo números son permitidos.</div>';
    } elseif (empty($this->Edad)) {
      self::$ErrEdad = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrEdad;
  }

  public function validaSexo()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Sexo)) {
      self::$ErrSexo = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Sexo)) {
      self::$ErrSexo = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrSexo;
  }

  public function validaPeso()
  {
    if (!preg_match("/^(\d+|\d+\.\d+)$/", $this->Peso)) {
      self::$ErrPeso = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Peso)) {
      self::$ErrPeso = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrPeso;
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
    if ((!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre)) || (!preg_match("/^([0-9])*$/", $this->Edad))
      || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Tipo)) || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Raza))
      || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Sexo)) || (!preg_match("/^(\d+|\d+\.\d+)$/", $this->Peso)) || (!$this->FKFinca)
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
    $query = "SELECT DISTINCT lt.Id, lt.Nombre_Lugar, lt.Numero_Contacto, lt.Descripcion, lt.Correo, lt.Imagen, 
              te.Espacio, lt.Hora_apertura, lt.Hora_clausura, lt.Ubicacion, cl.categoria_turismo, 
              dl.Nombre_Dial, dll.Nombre_Diall, cl.categoria_turismo, e.Estado
              FROM lugar_turistico lt
              INNER JOIN categoria_lugar cl
              ON lt.categoria_Id = cl.Id
              INNER JOIN tipo_espacio te
              ON lt.TipoEspacio_Id = te.Id
              INNER JOIN dias_lugar_l dl
              ON lt.DiaApertura_Id = dl.Id
              INNER JOIN dias_lugar_ll dll
              ON lt.DiaClausura_Id = dll.Id
              INNER JOIN estado e
              ON lt.FK_Estado = e.Id
              WHERE e.Estado = 'Activo' OR e.Estado = 'Inactivo'";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public static function innerJoinSolicitud()
  {
    $query = "SELECT DISTINCT lt.Id, lt.Nombre_Lugar, lt.Numero_Contacto, lt.Descripcion, lt.Correo, lt.Imagen, 
              te.Espacio, lt.Hora_apertura, lt.Hora_clausura, lt.Ubicacion, cl.categoria_turismo, 
              dl.Nombre_Dial, dll.Nombre_Diall, cl.categoria_turismo, e.Estado
              FROM lugar_turistico lt
              INNER JOIN categoria_lugar cl
              ON lt.categoria_Id = cl.Id
              INNER JOIN tipo_espacio te
              ON lt.TipoEspacio_Id = te.Id
              INNER JOIN dias_lugar_l dl
              ON lt.DiaApertura_Id = dl.Id
              INNER JOIN dias_lugar_ll dll
              ON lt.DiaClausura_Id = dll.Id
              INNER JOIN estado e
              ON lt.FK_Estado = e.Id
              WHERE e.Estado = 'Solicitud'";

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
    $query = "SELECT DISTINCT lt.Id, lt.Nombre_Lugar, lt.Numero_Contacto, lt.Descripcion, lt.Correo, lt.Imagen, 
              lt.TipoEspacio_Id, lt.Hora_apertura, lt.Hora_clausura, lt.Ubicacion, lt.categoria_Id, 
              lt.DiaApertura_Id, lt.DiaClausura_Id
              FROM lugar_turistico lt 
              WHERE Id = $Id";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }
}
