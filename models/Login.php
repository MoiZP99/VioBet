<?php

namespace Model;

class Login
{

  //Base de datos
  protected static $db;
  protected static $tabla = 'usuarios';
  protected static $columnasDB = ['Id', 'Email', 'Password', 'Rol_Id', 'FK_Estado'];

  //Errores
  public static $errores;
  public static $ErrContraseña;
  public static $ErrEmail;

  //
  public $Id;
  public $Password;
  public $Email;
  public $Rol_Id;
  public $FK_Estado;




  public function __construct($args = [])
  {
    $this->Id = $args['Id'] ?? null;
    $this->Password = $args['Password'] ?? '';
    $this->Email = $args['Email'] ?? '';
    $this->Rol_Id = $arg['Rol_Id'] ?? '';
    $this->FK_Estado = $arg['FK_Estado'] ?? '';
  }

  //Definir la conexion de la BDs
  public static function setDB($database)
  {
    self::$db = $database;
  }

  //Validar
  public static function getErrores()
  {
    return self::$errores;
  }

  public static function getErrContraseña()
  {
    return self::$ErrContraseña;
  }

  public static function getErrEmail()
  {
    return self::$ErrEmail;
  }

  public function validaEmail()
  {
    if (empty($this->Email)) {
      self::$ErrEmail = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Correo electrónico" no debe estar en blanco.</div>';
    } elseif (!preg_match("/^(\W|^)[a-zA-Z][\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)/", $this->Email)) {
      self::$ErrEmail = '<div style="padding-inline: 12px;"><strong>Error!</strong> Debe añadir un correo electrónico válido.</div>';
    }

    return self::$ErrEmail;
  }

  public function validar()
  {
    if (!$this->Email) {
      self::$errores[] = 'El Correo es obligatorio';
    }
    if (!$this->Password) {
      self::$errores[] = 'La Contraseña es obligatorio';
    }
    return self::$errores;
  }

  public function existeUsuario()
  {
    //Revisar si el usuario existe o no
    $query = "SELECT Id,Email,Password,Rol_Id,FK_Estado FROM usuarios WHERE Email = '" . $this->Email . "' LIMIT 1";

    $resultado = self::$db->query($query);

    if (!$resultado->num_rows) {
      self::$errores[] = 'El Usuario no existe';
      return;
    }
    return $resultado;
  }

  public function comprobarPassword($resultado)
  {
    $usuario = $resultado->fetch_object();

    $autenticado = password_verify($this->Password, $usuario->Password);

    if (!$autenticado) {
      self::$errores[] = 'La Contraseña es incorrecta';
    }
    return $autenticado;
  }

  public function comprobaractividad()
  {
    $query = "SELECT FK_Estado FROM usuarios WHERE Email = '" . $this->Email . "' and FK_Estado=1 LIMIT 1";

    $resultado2 = self::$db->query($query);

    if (!$resultado2->num_rows) {
      self::$errores[] = 'El usuario no está activo';
      return;
    }
    return $resultado2;
  }

  public function autenticar()
  {
    session_start();
    //Llenar el arreglo de sesion
    $_SESSION['usuario'] = $this->Email;
    $_SESSION['login'] = true;
    //ver el rol del usuario
    $query = "SELECT Rol_Id FROM usuarios WHERE Email = '" . $this->Email . "' and Rol_Id=2 LIMIT 1";

    $result = self::$db->query($query);
    if (!$result->num_rows) {
      $_SESSION['rol'] = true;
    } else {
      $_SESSION['rol'] = false;
    }


    header('Location: /principal/index');
  }
}
