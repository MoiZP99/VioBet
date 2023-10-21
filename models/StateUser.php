<?php

namespace Model;

class StateUser
{
  protected static $db;
  protected static $tblRol = ['IdRol', 'Nombre'];

  public static $errores = [];

  public static function setDB($database)
  {
    self::$db = $database;
  }

  public $Id;
  public $Nombre;

  public function __construct($args = [])
  {
    $this->Id = $args['IdRol'] ?? null;
    $this->Nombre = $args['Nombre'] ?? '';
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
    $resultadorol = self::$db->query($query);

    //iterar el resultado
    $array = [];
    while ($registro = $resultadorol->fetch_assoc()) {
      //Se combierte a objeto
      $array[] = self::crearObjeto($registro);
    }

    //liberar memoria
    $resultadorol->free();

    //retornar resultado
    return $array;
  }

  public static function all()
  {
    $query = "SELECT IdRol, Nombre FROM rol WHERE Nombre = 'Administrador' OR Nombre = 'Visualizador'";

    $resultadorol = self::consultarSQL($query);

    return $resultadorol;
  }

  public function atributos()
  {
    //De esta manera los atributos se va a ir mapeando con las columnas de la BDs
    $atributos = [];
    foreach (self::$tblRol as $columna) {
      if ($columna === 'IdRol') continue;
      $atributos[$columna] = $this->$columna;
    }

    return $atributos;
  }

  public function sanitizarAtributos()
  {
    //Se obtienen los atributos
    $atributos = $this->atributos();

    //Se recorren
    $sanitizado = [];

    //Sanitiza los atributos identificados
    //El foreach es porque es un arreglo asociativo
    foreach ($atributos as $key => $value) {
      $sanitizado[$key] = self::$db->escape_string($value); //Este escape es antes de que se guarde en la base de datos
    }

    return $sanitizado;
  }

  public function guardar()
  {
    if (!is_null($this->Id)) {
      // actualizar
      $this->actualizar();
    } else {
      // Se crea un nuevo registro
      $this->crear();
    }
  }

  //compara y sincroniza los datos por medio de un  arreglo y remmplaza los datos actualizados
  public function sincronizar($args=[]) { //sanitizs para guardarlo en la base de datos
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
}

  public function crear()
  {
    //Sanitizar los datos
    $atributos = $this->sanitizarAtributos();

    //insertar los datos
    // $query = " INSERT INTO lugar_turistico (Nombre_Lugar, Numero_Contacto, Descripcion, Correo, Imagen, TipoEspacio_Id, Hora_apertura, Hora_clausura, DiaApertura_Id, DiaClausura_Id, Ubicacion, categoria_Id) 
    // VALUES ('$this->Nombre_Lugar', '$this->Numero_Contacto', '$this->Descripcion', '$this->Correo', '$this->Imagen', '$this->TipoEspacio_Id', '$this->Hora_apertura', '$this->Hora_clausura', '$this->DiaApertura_Id', '$this->DiaClausura_Id','$this->Ubicacion', '$this->categoria_Id')";

    $query = " INSERT INTO rol ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' ";
    $query .= join("', '", array_values($atributos));
    $query .= " ') ";


    $resultado = self::$db->query($query);
    
    return $resultado;
  }

  public function actualizar()
  {
    // Sanitizar los datos
    $atributos = $this->sanitizarAtributos();

    $valores = [];
    foreach ($atributos as $key => $value) {
      $valores[] = "{$key}='{$value}'";
    }

    $query = "UPDATE rol SET ";
    $query .=  join(', ', $valores);
    $query .= " WHERE IdRol = '" . self::$db->escape_string($this->Id) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }

  public function eliminar()
  {
    // Eliminar el registro
    $query = "DELETE FROM rol WHERE IdRol = " . self::$db->escape_string($this->Id) . " LIMIT 1";
    $resultado = self::$db->query($query);

    return $resultado;
  }

  public static function find($Id)
  {
    $query = "SELECT IdRol, Nombre FROM rol WHERE IdRol = $Id";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);  //torna el primer elemento de un arreglo;
  }

  public static function getErrores()
  {
    return self::$errores;
  }

  public function validar()
  {
    if (!$this->Nombre) {
      self::$errores[] = "Debe anadir un rol";
    }

    return self::$errores;
  }
}
