<?php

namespace Model;

class FichaMedica
{
  protected static $db;
  protected static $columnasDB = ['IdFichaMedica', 'TipoMedicamento','Antecedentes', 'Sintomas', 'Diagnostico', 'DetalleMedicamento', 'FechaRevision', 'FKAnimal'];

  public static $errores;
  public static $ErrVac;
  public static $ErrAnte;
  public static $ErrSinto;
  public static $ErrDiagno;
  public static $ErrMedi;
  public static $ErrFecha;
  public static $ErrFKAnimal;

  public $IdFichaMedica;
  public $TipoMedicamento;
  public $Antecedentes;
  public $Sintomas;
  public $Diagnostico;
  public $DetalleMedicamento;
  public $FechaRevision;
  public $FKAnimal;
  public $Nombre;

  public function __construct($args = [])
  {
    $this->IdFichaMedica = $args['IdFichaMedica'] ?? null;
    $this->TipoMedicamento = $args['TipoMedicamento'] ?? '';
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
    if (!is_null($this->IdFichaMedica)) {
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

    $query = " INSERT INTO fichamedica ( ";
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

    $query = "UPDATE fichamedica SET ";
    $query .=  join(', ', $valores);
    $query .= " WHERE IdFichaMedica = '" . self::$db->escape_string($this->IdFichaMedica) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }


  public static function get($limite)
  {
    $query = "SELECT DISTINCT IdFichaMedica, TipoMedicamento, Antecedentes, Sintomas, Diagnostico, DetalleMedicamento, FechaRevision
              FROM fichamedica
              LIMIT $limite";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public function atributos()
  {
    $atributos = [];
    foreach (self::$columnasDB as $columna) {
      if ($columna === 'IdFichaMedica') continue;
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
    $query = "DELETE FROM fichamedica WHERE IdFichaMedica = " . self::$db->escape_string($this->IdFichaMedica) . " LIMIT 1";
    $resultado = self::$db->query($query);

    return $resultado;
  }

  public static function getErrores()
  {
    return self::$errores;
  }

  public static function getErrVac()
  {
    return self::$ErrVac;
  }


  public static function getErrAnte()
  {
    return self::$ErrAnte;
  }

  public static function getErrSinto()
  {
    return self::$ErrSinto;
  }

  public static function getErrDiagno()
  {
    return self::$ErrDiagno;
  }

  public static function getErrMedi()
  {
    return self::$ErrMedi;
  }

  public static function getErrFecha()
  {
    return self::$ErrFecha;
  }

  public static function getErrFKAnimal()
  {
    return self::$ErrFKAnimal;
  }

  public function validaTipoMedicamento()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->TipoMedicamento)) {
      self::$ErrVac = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->TipoMedicamento)) {
      self::$ErrVac = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrVac;
  }

 
  public function validaAntecedentes()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Antecedentes)) {
      self::$ErrAnte = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Antecedentes)) {
      self::$ErrAnte = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrAnte;
  }

  public function validaSintomas()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Sintomas)) {
      self::$ErrSinto = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Sintomas)) {
      self::$ErrSinto = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrSinto;
  }

  public function validaDiagnostico()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Diagnostico)) {
      self::$ErrDiagno = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Diagnostico)) {
      self::$ErrDiagno = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrDiagno;
  }

  public function validaMedicamento()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->DetalleMedicamento)) {
      self::$ErrMedi = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->DetalleMedicamento)) {
      self::$ErrMedi = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrMedi;
  }

  public function validaFecha()
  {
    if (empty($this->FechaRevision)) {
        self::$ErrFecha = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
      }
    return self::$ErrFecha;
  }


  public function validaAnimal()
  {
    if (!($this->FKAnimal)) {
      self::$ErrFKAnimal = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo es requerido.</div>';
    }

    return self::$ErrFKAnimal;
  }

  public function validar()
  {
    if ((!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->TipoMedicamento)) || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Sintomas))
      || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Diagnostico))|| (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Antecedentes)) || (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->DetalleMedicamento))
      || (!$this->FKAnimal)
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
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser, 
                              a.IdAnimal, a.Nombre, a.Tipo, a.Raza, a.Edad, a.Sexo, a.Peso, a.Numero, a.FKFinca, m.IdFichaMedica, 
                              m.TipoMedicamento, m.Antecedentes, m.Sintomas, m.Diagnostico, m.DetalleMedicamento, 
                              m.FechaRevision, m.FKAnimal
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              INNER JOIN Animal a
              ON a.FKFinca = f.IdFinca
              INNER JOIN fichamedica m
              ON a.FKAnimal = a.IdAnimal
              WHERE f.FKUsuario = $idUsuarioSesion";
              
    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public static function innerJoin()
  {
    $idUsuarioSesion = $_SESSION['idUsuario'];
    $query = "SELECT DISTINCT f.IdFinca, f.NombreFinca, f.Ubicacion, f.Tamano, f.FKUsuario, u.IdUsuario, u.NombreUser, a.IdAnimal, a.Nombre, a.Tipo, a.Raza, a.Edad, a.Sexo, a.Peso, a.Numero, a.FKFinca, m.IdFichaMedica, m.TipoMedicamento, m.Antecedentes, m.Sintomas, m.Diagnostico, m.DetalleMedicamento, m.FechaRevision, m.FKAnimal
              FROM finca f
              INNER JOIN Usuario u
              ON f.FKUsuario = u.IdUsuario
              INNER JOIN Animal a
              ON a.FKFinca = f.IdFinca
              INNER JOIN fichamedica m
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
    $query = "SELECT DISTINCT IdFichaMedica, TipoMedicamento, Antecedentes, Sintomas, Diagnostico, DetalleMedicamento, FechaRevision
              FROM fichamedica
              WHERE IdFichaMedica = $Id";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }
}
