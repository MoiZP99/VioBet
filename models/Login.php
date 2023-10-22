<?php

namespace Model;

class Login extends Finca
{

  //Base de datos
  protected static $db;
  protected static $tabla = 'usuario';
  protected static $columnasDB = ['IdUsuario', 'Email', 'Contrasena'];

  //Errores
  public static $errores;
  public static $ErrContraseña;
  public static $ErrEmail;

  //
  public $IdUsuario;
  public $Contrasena;
  public $Email;


  public function __construct($args = [])
  {
    $this->IdUsuario = $args['IdUsuario'] ?? null;
    $this->Contrasena = $args['Contrasena'] ?? '';
    $this->Email = $args['Email'] ?? '';
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
    if (!$this->Contrasena) {
      self::$errores[] = 'La Contraseña es obligatorio';
    }
    return self::$errores;
  }

  public function existeUsuario()
  {
    //Revisar si el usuario existe o no
    $query = "SELECT IdUsuario, Email, Contrasena FROM usuario WHERE Email = '" . $this->Email . "' LIMIT 1";

    $resultado = self::$db->query($query);

    if (!$resultado->num_rows) {
      self::$errores[] = 'El Usuario no existe';
      return;
    }
    return $resultado;
  }

  public function comprobarContrasena($resultado)
  {
    $usuario = $resultado->fetch_object();

    $autenticado = password_verify($this->Contrasena, $usuario->Contrasena);

    if (!$autenticado) {
      self::$errores[] = 'La Contraseña es incorrecta';
    }
    return $autenticado;
  }

  public function autenticar()
  {
    session_start();
    //Llenar el arreglo de sesion
    $_SESSION['usuario'] = $this->Email;
    $_SESSION['login'] = true;
    //ver el rol del usuario
    $query = "SELECT * FROM Usuario u
              INNER JOIN Finca f ON u.IdUsuario = f.FKUsuario
              WHERE u.Email = '" . $this->Email . "' LIMIT 1";

    $result = self::$db->query($query);
    
    if ($result->num_rows) {
        // El usuario ha sido autenticado
        $row = $result->fetch_assoc();
        $_SESSION['login'] = true;
        $_SESSION['usuario'] = $this->Email;
        $_SESSION['idUsuario'] = $row['IdUsuario']; // Almacena el ID del usuario en la sesión
        header('Location: /principal/index'); // Redirige al panel de administración
    } else {
        $_SESSION['login'] = false;
        // Puedes mostrar un mensaje de error o redirigir de nuevo a la página de inicio de sesión
        header('Location: /');
    }
  }
}
