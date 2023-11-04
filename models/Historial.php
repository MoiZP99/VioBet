<?php

namespace Model;

class Historial
{
  protected static $db;
  protected static $columnasDB = ['IdHistorial', 'TipoMedicamento', 'TipoSangre', 'Antecedentes', 'Sintomas', 'Diagnostico', 'DetalleMedicamento', 'FechaRevision', 'FKAnimal', 'FechaRegistro'];

  public $IdHistorial;
  public $TipoMedicamento;
  public $TipoSangre;
  public $Antecedentes;
  public $Sintomas;
  public $Diagnostico;
  public $DetalleMedicamento;
  public $FechaRevision;
  public $FKAnimal;
  public $Nombre;

  public function __construct($args = [])
  {
    $this->IdHistorial = $args['IdHistorial'] ?? null;
    $this->TipoMedicamento = $args['TipoMedicamento'] ?? '';
    $this->TipoSangre = $args['TipoSangre'] ?? '';
    $this->Antecedentes = $args['Antecedentes'] ?? '';
    $this->Sintomas = $args['Sintomas'] ?? '';
    $this->Diagnostico = $args['Diagnostico'] ?? '';
    $this->DetalleMedicamento = $args['DetalleMedicamento'] ?? '';
    $this->FechaRevision = $args['FechaRevision'] ?? '';
    $this->FKAnimal = $args['FKAnimal'] ?? '';
  }

  public static function setDB($database)
  {
    self::$db = $database;
  }

  public function guardar()
  {
    if (!is_null($this->IdHistorial)) {
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

    $query = " INSERT INTO historial ( ";
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

    $query = "UPDATE historial SET ";
    $query .=  join(', ', $valores);
    $query .= " WHERE IdHistorial = '" . self::$db->escape_string($this->IdHistorial) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }


  public static function get()
  {
    // $idUsuarioSesion = $_SESSION['idUsuario'];
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser, a.IdAnimal,
                              a.Nombre, a.Tipo, a.Raza, a.Edad, a.Sexo, a.Peso, a.Numero, a.FKFinca, e.IdHistorial, e.TipoMedicamento, 
                              e.TipoSangre, e.Antecedentes, e.Sintomas, e.Diagnostico, e.DetalleMedicamento, e.FechaRevision, e.FKAnimal
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              INNER JOIN Animal a
              ON a.FKFinca = f.IdFinca
              INNER JOIN historial e
              ON e.FKAnimal = a.IdAnimal";
            //   WHERE f.FKUsuario = $idUsuarioSesion

    // $query = "SELECT DISTINCT IdHistorial, TipoMedicamento, TipoSangre, Antecedentes, Sintomas, Diagnostico, DetalleMedicamento, FechaRevision
    //           FROM historial
    //           LIMIT $limite";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public function atributos()
  {
    $atributos = [];
    foreach (self::$columnasDB as $columna) {
      if ($columna === 'IdHistorial') continue;
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
    $query = "DELETE FROM historial WHERE IdHistorial = " . self::$db->escape_string($this->IdHistorial) . " LIMIT 1";
    $resultado = self::$db->query($query);

    return $resultado;
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
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser, a.IdAnimal, a.Nombre, a.Tipo, a.Raza, a.Edad, a.Sexo, a.Peso, a.Numero, a.FKFinca, m.IdHistorial, m.TipoMedicamento, m.TipoSangre, m.Antecedentes, m.Sintomas, m.Diagnostico, m.DetalleMedicamento, m.FechaRevision, m.FKAnimal
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              INNER JOIN Animal a
              ON a.FKFinca = f.IdFinca
              INNER JOIN historial m
              ON a.FKAnimal = a.IdAnimal
              WHERE f.FKUsuario = $idUsuarioSesion";
              

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public static function innerJoin()
  {
    $idUsuarioSesion = $_SESSION['idUsuario'];
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser, a.IdAnimal,
                              a.Nombre, a.Tipo, a.Raza, a.Edad, a.Sexo, a.Peso, a.Numero, a.FKFinca, e.IdHistorial, e.TipoMedicamento, 
                              e.TipoSangre, e.Antecedentes, e.Sintomas, e.Diagnostico, e.DetalleMedicamento, e.FechaRevision, e.FKAnimal
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              INNER JOIN Animal a
              ON a.FKFinca = f.IdFinca
              INNER JOIN historial e
              ON m.FKAnimal = a.IdAnimal
              WHERE f.FKUsuario = $idUsuarioSesion";

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
    $query = "SELECT DISTINCT IdHistorial, TipoMedicamento, TipoSangre, Antecedentes, Sintomas, Diagnostico, DetalleMedicamento, FechaRevision
              FROM historial
              WHERE IdHistorial = $Id";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }
}
