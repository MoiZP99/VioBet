<?php

namespace Model;

class Place
{

  //Base de datos
  protected static $db;
  protected static $columnasDB = ['Id', 'Nombre_Lugar', 'Numero_Contacto', 'Descripcion', 'Correo', 'Imagen', 'TipoEspacio_Id', 'Hora_apertura', 'Hora_clausura', 'Ubicacion', 'categoria_Id', 'DiaApertura_Id', 'DiaClausura_Id', 'FK_Estado'];

  //Errores
  public static $errores;
  public static $ErrNombPer;
  public static $ErrContacto;
  public static $ErrDescrip;
  public static $ErrLugar;
  public static $ErrHoraI;
  public static $ErrHoraF;
  public static $ErrDiaI;
  public static $ErrDiaF;
  public static $ErrImg;
  public static $ErrCorreo;
  public static $ErrUbi;
  public static $ErrCate;
  public static $ErrEstado;

  public $Id;
  public $Nombre_Lugar;
  public $Numero_Contacto;
  public $Descripcion;
  public $Correo;
  public $Imagen;
  public $TipoEspacio_Id;
  public $Hora_apertura;
  public $Hora_clausura;
  public $Ubicacion;
  public $categoria_Id;
  public $DiaApertura_Id;
  public $DiaClausura_Id;
  public $FK_Estado;
  public $Espacio; //join
  public $categoria_turismo; //join
  public $Nombre_Dial; //join
  public $Nombre_Diall; //join
  public $Estado; //join

  public function __construct($args = [])
  {
    $this->Id = $args['Id'] ?? null;
    $this->Nombre_Lugar = $args['Nombre_Lugar'] ?? '';
    $this->Numero_Contacto = $args['Numero_Contacto'] ?? '';
    $this->Descripcion = $args['Descripcion'] ?? '';
    $this->Correo = $args['Correo'] ?? '';
    $this->Imagen = $args['Imagen'] ?? '';
    $this->TipoEspacio_Id = $args['TipoEspacio_Id'] ?? '';
    $this->Hora_apertura = $args['Hora_apertura'] ?? '';
    $this->Hora_clausura = $args['Hora_clausura'] ?? '';
    $this->Ubicacion = $args['Ubicacion'] ?? '';
    $this->categoria_Id = $args['categoria_Id'] ?? '';
    $this->DiaApertura_Id = $args['DiaApertura_Id'] ?? '';
    $this->DiaClausura_Id = $args['DiaClausura_Id'] ?? '';
    $this->FK_Estado = $args['FK_Estado'] ?? '';
  }

  public static function setDB($database)
  {
    self::$db = $database;
  }

  public function guardar()
  {
    if (!is_null($this->Id)) {
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

    $query = " INSERT INTO lugar_turistico ( ";
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

    $query = "UPDATE lugar_turistico SET ";
    $query .=  join(', ', $valores);
    $query .= " WHERE Id = '" . self::$db->escape_string($this->Id) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }


  public static function get($limite)
  {
    $query = "SELECT DISTINCT Id, Nombre_Lugar, Numero_Contacto, Descripcion, Correo, Imagen, 
              Hora_apertura, Hora_clausura, Ubicacion, FK_Estado
              FROM lugar_turistico
              WHERE FK_Estado = 1
              LIMIT $limite";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public function atributos()
  {
    $atributos = [];
    foreach (self::$columnasDB as $columna) {
      if ($columna === 'Id') continue;
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

  public function setImagen($Imagen)
  {
    if (!is_null($this->Id)) {
      $this->borrarImagen();
    }

    if ($Imagen) {
      $this->Imagen = $Imagen;
    }
  }

  public function eliminar()
  {
    $query = "DELETE FROM lugar_turistico WHERE Id = " . self::$db->escape_string($this->Id) . " LIMIT 1";
    $resultado = self::$db->query($query);

    if ($resultado) {
      $this->borrarImagen();
    }

    return $resultado;
  }

  public function borrarImagen()
  {
    $existeArchivo = file_exists(CARPETA_IMAGENES . $this->Imagen); //Se hace eso porque tienme la referencia en el objetp y nunca se va a perder
    if ($existeArchivo) {
      unlink(CARPETA_IMAGENES . $this->Imagen);
    }
  }

  public static function getErrores()
  {
    return self::$errores;
  }

  public static function getErrNombPer()
  {
    return self::$ErrNombPer;
  }

  public static function getErrContacto()
  {
    return self::$ErrContacto;
  }

  public static function getErrDescrip()
  {
    return self::$ErrDescrip;
  }

  public static function getErrLugar()
  {
    return self::$ErrLugar;
  }

  public static function getErrHoraI()
  {
    return self::$ErrHoraI;
  }

  public static function getErrHoraF()
  {
    return self::$ErrHoraF;
  }

  public static function getErrDiaI()
  {
    return self::$ErrDiaI;
  }

  public static function getErrDiaF()
  {
    return self::$ErrDiaF;
  }

  public static function getErrImg()
  {
    return self::$ErrImg;
  }

  public static function getErrCorreo()
  {
    return self::$ErrCorreo;
  }

  public static function getErrUbi()
  {
    return self::$ErrUbi;
  }

  public static function getErrCate()
  {
    return self::$ErrCate;
  }

  public static function getErrEstado()
  {
    return self::$ErrEstado;
  }

  public function validaNombre()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre_Lugar)) {
      self::$ErrNombPer = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Nombre_Lugar)) {
      self::$ErrNombPer = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Nombre" no debe estar en blanco.</div>';
    }

    return self::$ErrNombPer;
  }

  public function validaContacto()
  {
    if (!preg_match("/^([0-9]{8})*$/", $this->Numero_Contacto)) {
      self::$ErrContacto = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo números son permitidos.</div>';
    } elseif (empty($this->Numero_Contacto)) {
      self::$ErrContacto = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Número de teléfono" no debe estar en blanco.</div>';
    }

    return self::$ErrContacto;
  }

  public function validaDescrip()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Descripcion)) {
      self::$ErrDescrip = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Descripcion)) {
      self::$ErrDescrip = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Descripción" no debe estar en blanco.</div>';
    } elseif (strlen($this->Descripcion) < 50) {
      self::$ErrDescrip = '<div style="padding-inline: 12px;"><strong>Error!</strong> Debe anadir al menos 50 caracteres.</div>';
    }

    return self::$ErrDescrip;
  }

  public function validaLugar()
  {
    if (empty($this->TipoEspacio_Id)) {
      self::$ErrLugar = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Tipo de Lugar" no debe estar en blanco.</div>';
    }

    return self::$ErrLugar;
  }

  public function validaHoraI()
  {
    if (empty($this->Hora_apertura)) {
      self::$ErrHoraI = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Hora de apertura" no debe estar en blanco.</div>';
    }

    return self::$ErrHoraI;
  }

  public function validaHoraF()
  {
    if (empty($this->Hora_clausura)) {
      self::$ErrHoraF = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Hora de cierre" no debe estar en blanco.</div>';
    }

    return self::$ErrHoraF;
  }

  public function validaDiaI()
  {
    if (empty($this->DiaApertura_Id)) {
      self::$ErrDiaI = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Día de apertura" no debe estar en blanco.</div>';
    }

    return self::$ErrDiaI;
  }

  public function validaDiaF()
  {
    if (empty($this->DiaClausura_Id)) {
      self::$ErrDiaF = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Día de cierre" no debe estar en blanco.</div>';
    }

    return self::$ErrDiaF;
  }

  public function validaImg()
  {
    if (!$this->Imagen) {
      self::$ErrImg = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Imagen" no debe estar en blanco.</div>';
    }

    return self::$ErrImg;
  }

  public function validaCorreo()
  {
    if (empty($this->Correo)) {
      self::$ErrCorreo = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Correo electrónico" no debe estar en blanco.</div>';
    } elseif (!preg_match("/^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/", $this->Correo)) {
      self::$ErrCorreo = '<div style="padding-inline: 12px;"><strong>Error!</strong> Debe añadir un correo electrónico válido.</div>';
    }

    return self::$ErrCorreo;
  }

  public function validaUbi()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ0-9\s]*$/", $this->Ubicacion)) {
      self::$ErrUbi = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Ubicacion)) {
      self::$ErrUbi = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Ubicación" no debe estar en blanco.</div>';
    }

    return self::$ErrUbi;
  }

  public function validaCate()
  {
    if (empty($this->categoria_Id)) {
      self::$ErrCate = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Categoría" no debe estar en blanco.</div>';
    }

    return self::$ErrCate;
  }

  public function validaEstado()
  {
    if (empty($this->FK_Estado)) {
      self::$ErrEstado = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Estado" no debe estar en blanco.</div>';
    }

    return self::$ErrEstado;
  }

  public function validar()
  {
    if ( (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre_Lugar)) || (!preg_match("/^([0-9]{8})*$/", $this->Numero_Contacto)) 
      || ((!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Descripcion)) || (strlen($this->Descripcion) < 50)) 
      || (!$this->TipoEspacio_Id) || (!$this->Hora_apertura) || (!$this->Hora_clausura) || (!$this->DiaApertura_Id) || (!$this->DiaClausura_Id)
      || ((!preg_match("/^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/", $this->Correo)) || (empty($this->Correo)))
      || ((!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ0-9\s]*$/", $this->Ubicacion)) || (empty($this->Ubicacion))) || (!$this->categoria_Id)
      || (!$this->FK_Estado)
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
    $query = "SELECT lt.Id, lt.Nombre_Lugar, lt.Numero_Contacto, lt.Descripcion, lt.Correo, lt.Imagen, 
              lt.TipoEspacio_Id, lt.Hora_apertura, lt.Hora_clausura, lt.Ubicacion, lt.categoria_Id, 
              lt.DiaApertura_Id, lt.DiaClausura_Id
              FROM lugar_turistico lt";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

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

    $resultadoLugar = self::consultarSQL($query);

    return $resultadoLugar;
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

    $resultadoLugar = self::consultarSQL($query);

    return $resultadoLugar;
  }

  public function generarPaginacion($page, $totalPages)
{
    $pagination = '<div class="pagination">';
    $pagination .= '<ul>';

    if ($page > 1) {
        $pagination .= "<li><a href='/places?page=1'>&laquo;</a></li>";

        if ($page > 3) {
            $pagination .= "<li><span>...</span></li>";
        }
    }

    $startPage = max(1, $page - 2);
    $endPage = min($totalPages, $page + 2);

    for ($i = $startPage; $i <= $endPage; $i++) {
        $activeClass = ($i == $page) ? 'active' : '';
        $pagination .= "<li class='$activeClass'><a href='/places?page=$i'>$i</a></li>";
    }

    if ($page < $totalPages - 2) {
        $pagination .= "<li><span>...</span></li>";
    }

    if ($page < $totalPages) {
        $pagination .= "<li><a href='/places?page=$totalPages'>&raquo;</a></li>";
    }

    $pagination .= '</ul>';
    $pagination .= '</div>';

    return $pagination;
}


  public static function obtenerTotalRegistros()
  {
    $query = "SELECT DISTINCT Id, Nombre_Lugar, Descripcion, Imagen
              FROM lugar_turistico
              WHERE FK_Estado = 1";

    $resultado = self::consultarSQL($query);

    $totalRecords = count($resultado);

    return $totalRecords;
  }

  public static function obtenerRegistrosPaginados($limit, $offset)
  {
    $query = "SELECT DISTINCT Id, Nombre_Lugar, Descripcion, Imagen
              FROM lugar_turistico
              WHERE FK_Estado = 1
              LIMIT $limit OFFSET $offset";

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
