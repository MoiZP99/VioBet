<?php

namespace Model;

class Animal
{
  protected static $db;
  protected static $columnasDB = ['IdAnimal', 'Nombre', 'Tipo', 'TipoSangre','Raza', 'Edad', 'Sexo', 'Peso', 'Numero', 'FKFinca'];

  public static $errores;
  public static $ErrNomb;
  public static $ErrTipo;
  public static $ErrSangr;
  public static $ErrRaza;
  public static $ErrEdad;
  public static $ErrSexo;
  public static $ErrPeso;
  public static $ErrNum;

  public static $ErrFKFinca;

  public $IdAnimal;
  public $Nombre;
  public $Tipo;
  public $TipoSangre;
  public $Raza;
  public $Edad;
  public $Sexo;
  public $Peso;
  public $Numero;

  public $FKFinca;
  public $NombreFinca;

  public function __construct($args = [])
  {
    $this->IdAnimal = $args['IdAnimal'] ?? null;
    $this->Nombre = $args['Nombre'] ?? '';
    $this->Tipo = $args['Tipo'] ?? '';
    $this->TipoSangre = $args['TipoSangre'] ?? '';
    $this->Raza = $args['Raza'] ?? '';
    $this->Edad = $args['Edad'] ?? '';
    $this->Sexo = $args['Sexo'] ?? '';
    $this->Peso = $args['Peso'] ?? '';
    $this->Numero = $args['Numero'] ?? '';
   
    $this->FKFinca = $args['FKFinca'] ?? '';
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
    $query .= " WHERE IdAnimal = '" . self::$db->escape_string($this->IdAnimal) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }


  public static function get($limite)
  {
    $query = "SELECT DISTINCT IdAnimal, Nombre, Tipo,TipoSangre,  Raza, Edad, Sexo, Peso, Numero
              FROM animal
              LIMIT $limite";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

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
  public static function getErrSangr()
  {
    return self::$ErrSangr;
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

  public static function getErrNum()
  {
    return self::$ErrNum;
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

  public function validaTipo()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Tipo)) {
      self::$ErrTipo = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Tipo)) {
      self::$ErrTipo = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrTipo;
  }

  public function validaTipoSangre()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->TipoSangre)) {
      self::$ErrSangr = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->TipoSangre)) {
      self::$ErrSangr = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrSangr;
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
      self::$ErrPeso = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo números son permitidos.</div>';
    } elseif (empty($this->Peso)) {
      self::$ErrPeso = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrPeso;
  }


  public function validaNum()
  {
    if (!preg_match("/^([0-9])*$/", $this->Numero)) {
      self::$ErrFKFinca = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo números son permitidos.</div>';
    } elseif (empty($this->Numero)) {
      self::$ErrFKFinca = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrFKFinca;
  }

  public function validaFinca()
  {
    if (!($this->FKFinca)) {
      self::$ErrFKFinca = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrFKFinca;
  }

  public function validar()
  {
    if ((!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre)) || (!preg_match("/^([0-9])*$/", $this->Edad))
      || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Tipo)) || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Raza))
      || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->TipoSangre))  || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Sexo)) 
      || (!preg_match("/^(\d+|\d+\.\d+)$/", $this->Peso))|| (!preg_match("/^([0-9])*$/", $this->Numero)) || (!$this->FKFinca)
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
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser, a.IdAnimal, a.Nombre, a.Tipo, a.TipoSangre,a.Raza, a.Edad, a.Sexo, a.Peso, a.Numero, a.FKFinca
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              INNER JOIN Animal a
              ON a.FKFinca = f.IdFinca
              WHERE f.FKUsuario = $idUsuarioSesion";
              

    $resultado = self::consultarSQL($query);

    return $resultado;
  }
  
  public static function all1()
  {
    // $idUsuarioSesion = $_SESSION['idUsuario'];
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser, a.IdAnimal, a.Nombre, a.Tipo,a.TipoSangre, a.Raza, a.Edad, a.Sexo, a.Peso, a.Numero, a.FKFinca
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              INNER JOIN Animal a
              ON a.FKFinca = f.IdFinca";
              

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public static function innerJoin()
  {
    $idUsuarioSesion = $_SESSION['idUsuario'];
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser, a.IdAnimal, a.Nombre, a.Tipo,a.TipoSangre, a.Raza, a.Edad, a.Sexo, a.Peso, a.Numero, a.FKFinca
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              INNER JOIN Animal a
              ON a.FKFinca = f.IdFinca
              WHERE f.FKUsuario = $idUsuarioSesion";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  // public static function innerJoinSolicitud()
  // {
  //   $query = "SELECT DISTINCT lt.Id, lt.Nombre_Lugar, lt.Numero_Contacto, lt.Descripcion, lt.Correo, lt.Imagen, 
  //             te.Espacio, lt.Hora_apertura, lt.Hora_clausura, lt.Ubicacion, cl.categoria_turismo, 
  //             dl.Nombre_Dial, dll.Nombre_Diall, cl.categoria_turismo, e.Estado
  //             FROM lugar_turistico lt
  //             INNER JOIN categoria_lugar cl
  //             ON lt.categoria_Id = cl.Id
  //             INNER JOIN tipo_espacio te
  //             ON lt.TipoEspacio_Id = te.Id
  //             INNER JOIN dias_lugar_l dl
  //             ON lt.DiaApertura_Id = dl.Id
  //             INNER JOIN dias_lugar_ll dll
  //             ON lt.DiaClausura_Id = dll.Id
  //             INNER JOIN estado e
  //             ON lt.FK_Estado = e.Id
  //             WHERE e.Estado = 'Solicitud'";

  //   $resultado = self::consultarSQL($query);

  //   return $resultado;
  // }

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
    $query = "SELECT DISTINCT IdAnimal, Nombre, Tipo, TipoSangre,Raza, Edad, Sexo, Peso, Numero
              FROM animal
              WHERE IdAnimal = $Id";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }
}
