<?php

namespace Model;

class User
{

  //Base de datos
  protected static $db;
  protected static $tblUsuario = ['IdUsuario', 'NombreUser', 'Apellido1', 'Apellido2', 'Telefono', 'Email', 'Contrasena'];

  //Errores
  public static $errores;
  public static $ErrNomb;
  public static $ErrApel;
  public static $ErrApell;
  public static $ErrContraseña;
  public static $ErrTelefono;
  public static $ErrEmail;  // Alertas y Mensajes
  public static $alertas = [];

  public $IdUsuario;
  public $NombreUser;
  public $Apellido1;
  public $Apellido2;
  public $Telefono;
  public $Contrasena;
  public $Email;
  public $Password2;
  
  public function __construct($args = [])
  {
    $this->IdUsuario = $args['IdUsuario'] ?? null;
    $this->NombreUser = $args['NombreUser'] ?? '';
    $this->Apellido1 = $args['Apellido1'] ?? '';
    $this->Apellido2 = $args['Apellido2'] ?? '';
    $this->Telefono = $args['Telefono'] ?? '';
    $this->Contrasena = $args['Contrasena'] ?? '';
    $this->Password2 = $args['Password2'] ?? '';
    $this->Email = $args['Email'] ?? '';
  }


  //Definir la conexion de la BDs
  public static function setDB($database)
  {
    self::$db = $database;
  }


  public function guardar()
  {
    if (!is_null($this->IdUsuario)) {
      // actualizar
      $this->actualizar();
    } else {
      // Se crea un nuevo registro
      $this->crear();
    }
  }


  //compara y sincroniza los datos por medio de un  arreglo y remmplaza los datos actualizados
  public function sincronizar($args = [])
  { //sanitizs para guardarlo en la base de datos
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
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

    $query = " INSERT INTO usuario ( ";
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

    $query = "UPDATE usuario SET ";
    $query .=  join(', ', $valores);
    $query .= " WHERE IdUsuario = '" . self::$db->escape_string($this->IdUsuario) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);

    return $resultado;
  }


  //Identifica y une las columnas de la BDs
  public function atributos()
  {
    //De esta manera los atributos se va a ir mapeando con las columnas de la BDs
    $atributos = [];
    foreach (self::$tblUsuario as $columna) {
      if ($columna === 'IdUsuario') continue;
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


  // Eliminar un registro
  public function eliminar()
  {
    // Eliminar el registro
    $query = "DELETE FROM usuario WHERE IdUsuario = " . self::$db->escape_string($this->IdUsuario) . " LIMIT 1";
    $resultado = self::$db->query($query);

    return $resultado;
  }


  //Validar
  public static function getErrores()
  {
    return self::$errores;
  }

  public static function getErrNomb()
  {
    return self::$ErrNomb;
  }

  public static function getErrApel()
  {
    return self::$ErrApel;
  }

  public static function getErrApell()
  {
    return self::$ErrApell;
  }
  
  public static function getErrTel()
  {
    return self::$ErrTelefono;
  }

  public static function getErrContraseña()
  {
    return self::$ErrContraseña;
  }

  public static function getErrEmail()
  {
    return self::$ErrEmail;
  }
  

  public function validaNombre()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->NombreUser)) {
      self::$ErrNomb = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->NombreUser)) {
      self::$ErrNomb = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo no debe estar en blanco.</div>';
    }

    return self::$ErrNomb;
  }

  public function validaApel()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Apellido1)) {
      self::$ErrApel = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Apellido1)) {
      self::$ErrApel = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo no debe estar en blanco.</div>';
    }

    return self::$ErrApel;
  }

  public function validaApell()
  {
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Apellido2)) {
      self::$ErrApell = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
    } elseif (empty($this->Apellido2)) {
      self::$ErrApell = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo no debe estar en blanco.</div>';
    }

    return self::$ErrApell;
  }
  
  public function validaTelefono()
  {
    if (empty($this->Telefono)) {
      self::$ErrTelefono = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo no debe estar en blanco.</div>';
    }

    return self::$ErrTelefono;
  }


  public function validaContraseña()
  {
    if ($this->Contrasena != $this->Password2) {
      self::$ErrContraseña = '<div style="padding-inline: 12px;"><strong>Error!</strong> Las contrasñas no coinciden.</div>';
    } elseif (empty($this->Contrasena)) {
      self::$ErrContraseña = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo no debe ir en blanco.</div>';
    } elseif (empty($this->Password2)) {
      self::$ErrContraseña = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo no debe ir en blanco.</div>';
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*\d.*\d.*\d.*\d)(?=.*[*#@])[A-Za-z\d*#@]{8,16}$/", $this->Contrasena)) {
      self::$ErrContraseña = '<div style="padding-inline: 12px;"><strong>Error!</strong> La contraseña no cumple con los requisitos.</div>';
    }

    return self::$ErrContraseña;
  }
  
  public function validaEmail()
  {
    $query = "SELECT Email FROM usuario WHERE Email = '" . $this->Email . "' LIMIT 1";
    $resultado = self::consultarSQL($query);

    if ($resultado) {
      self::$ErrEmail = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este Email ya se encuentra registrado.</div>';
    } elseif (empty($this->Email)) {
      self::$ErrEmail = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo no debe estar en blanco.</div>';
    } elseif (!preg_match("/^(\W|^)[a-zA-Z][\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)/", $this->Email)) {
      self::$ErrEmail = '<div style="padding-inline: 12px;"><strong>Error!</strong> Debe añadir un correo electrónico válido.</div>';
    }

    return self::$ErrEmail;
  }
  
  public function validaEmailUpdate()
  {
    if (empty($this->Email)) {
      self::$ErrEmail = '<div style="padding-inline: 12px;"><strong>Error!</strong> Este campo no debe estar en blanco.</div>';
    } elseif (!preg_match("/^(\W|^)[a-zA-Z][\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)/", $this->Email)) {
      self::$ErrEmail = '<div style="padding-inline: 12px;"><strong>Error!</strong> Debe añadir un correo electrónico válido.</div>';
    }

    return self::$ErrEmail;
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
    $resultado = self::$db->query($query);

    //iterar el resultado
    $array = [];
    while ($registro = $resultado->fetch_assoc()) {
      //Se combierte a objeto
      $array[] = self::crearObjeto($registro);
    }

    //liberar memoria
    $resultado->free();

    //retornar resultado
    return $array;
  }


  //listar todos Lugares
  public static function all()
{
    $idUsuarioSesion = $_SESSION['idUsuario'];
    $query = "SELECT u.*, f.* FROM Usuario u
              LEFT JOIN Finca f
              ON u.IdUsuario = f.FKUsuario
              WHERE u.IdUsuario = $idUsuarioSesion LIMIT 1";

    $resultado = self::consultarSQL($query);

    if ($resultado) {
        return $resultado;
    } else {
        $query = "SELECT * FROM Usuario
                  WHERE IdUsuario = $idUsuarioSesion LIMIT 1";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
}



  // Busqueda Where con Columna 
  public static function where($columna, $valor)
  {
    $query = "SELECT * FROM usuario WHERE $columna = '$valor'";
    $resultado = self::consultarSQL($query);
    return array_shift(
      $resultado
    );
  }


  public static function setAlerta($tipo, $mensaje)
  {
    self::$alertas[$tipo][] = $mensaje;
  }
  // Validación
  public static function getAlertas()
  {
    return self::$alertas;
  }


  public static function innerJoin()
  {
    $idUsuarioSesion = $_SESSION['idUsuario'];

    $query = "SELECT DISTINCT IdUsuario, NombreUser, Apellido1, Apellido2, Telefono, Email, Contrasena
              FROM usuario
              WHERE IdUsuario = $idUsuarioSesion";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }


  // Busca un lugar por su id
  public static function find($IdUsuario)
  {
    $query = "SELECT * FROM usuario WHERE IdUsuario = $IdUsuario";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);  //torna el primer elemento de un arreglo;
  }


  public function hashPassword(): void
  {
    $this->Contrasena = password_hash($this->Contrasena, PASSWORD_BCRYPT);
  }
}
