<?php

namespace Model;

class Entrepreneur
{
    //Base de datos
    protected static $db;
    protected static $tblEmprendedor = ['Id', 'Nombre_Negocio', 'Nombre_Emprendedor', 'Apellido1', 'Apellido2', 'Nom_Producto', 'FK_Estado', 'Num_Telefono', 'Correo', 'FK_Tipo_Actividad', 'Imagen', 'Cedula', 'FK_feria_emprendedor'];

    //Errores
    public static $errores;
    public static $erroresActualizar;
    public static $ErrNombNegocio;
    public static $ErrNombPersona;
    public static $ErrApel;
    public static $ErrApell;
    public static $ErrNombProduct;
    public static $ErrTel;
    public static $ErrCorreo;
    public static $ErrActividad;
    public static $ErrImg;
    public static $ErrCedula;
    public static $ErrEstado;
    public static $ErrFeriaEmprende;

    public $Id;
    public $Nombre_Negocio;
    public $Nombre_Emprendedor;
    public $Apellido1;
    public $Apellido2;
    public $Nom_Producto;
    public $FK_Estado;
    public $Num_Telefono;
    public $Correo;
    public $FK_Tipo_Actividad;
    public $Imagen;
    public $Cedula;
    public $FK_feria_emprendedor;
    public $Nomb_Actividad; //join
    public $Estado; //join
    public $NombFeriaEmprende; //join

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre_Negocio = $args['Nombre_Negocio'] ?? '';
        $this->Nombre_Emprendedor = $args['Nombre_Emprendedor'] ?? '';
        $this->Apellido1 = $args['Apellido1'] ?? '';
        $this->Apellido2 = $args['Apellido2'] ?? '';
        $this->Nom_Producto = $args['Nom_Producto'] ?? '';
        $this->FK_Estado = $args['FK_Estado'] ?? '';
        $this->Num_Telefono = $args['Num_Telefono'] ?? '';
        $this->Correo = $args['Correo'] ?? '';
        $this->FK_Tipo_Actividad = $args['FK_Tipo_Actividad'] ?? '';
        $this->Imagen = $args['Imagen'] ?? '';
        $this->Cedula = $args['Cedula'] ?? '';
        $this->FK_feria_emprendedor = $args['FK_feria_emprendedor'] ?? '';
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

        $query = " INSERT INTO emprendedores ( ";
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

        $query = "UPDATE emprendedores SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE Id = '" . self::$db->escape_string($this->Id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        return $resultado;
    }


    public static function get($limite)
    {
        $query = "SELECT DISTINCT 
                  Id, Nombre_Negocio, Nombre_Emprendedor, Apellido1, Apellido2, Nom_Producto,
                  Num_Telefono, Correo, Imagen, Cedula, FK_Estado
                  FROM emprendedores
                  WHERE FK_Estado = 1
                  LIMIT $limite";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }


    public function atributos()
    {
        $atributos = [];
        foreach (self::$tblEmprendedor as $columna) {
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
        $query = "DELETE FROM emprendedores WHERE Id = " . self::$db->escape_string($this->Id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
        }

        return $resultado;
    }

    public function borrarImagen()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->Imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->Imagen);
        }
    }

    public function generarPaginacion($page, $totalPages)
    {
        $pagination = '<div class="pagination">';
        $pagination .= '<ul>';

        if ($page > 1) {
            $pagination .= "<li><a href='/entrepreneurs?page=1'>&laquo;</a></li>";

            if ($page > 3) {
                $pagination .= "<li><span>...</span></li>";
            }
        }

        $startPage = max(1, $page - 2);
        $endPage = min($totalPages, $page + 2);

        for ($i = $startPage; $i <= $endPage; $i++) {
            $activeClass = ($i == $page) ? 'active' : '';
            $pagination .= "<li class='$activeClass'><a href='/entrepreneurs?page=$i'>$i</a></li>";
        }

        if ($page < $totalPages - 2) {
            $pagination .= "<li><span>...</span></li>";
        }

        if ($page < $totalPages) {
            $pagination .= "<li><a href='/entrepreneurs?page=$totalPages'>&raquo;</a></li>";
        }

        $pagination .= '</ul>';
        $pagination .= '</div>';

        return $pagination;
    }

    public static function obtenerTotalRegistros()
    {
        $query = "SELECT DISTINCT 
                  Id, Nombre_Negocio, Nombre_Emprendedor, Apellido1, Apellido2, Nom_Producto,
                  Num_Telefono, Correo, Imagen, Cedula, FK_Estado
                  FROM emprendedores
                  WHERE FK_Estado = 1";

        $resultado = self::consultarSQL($query);

        $totalRecords = count($resultado);

        return $totalRecords;
    }

    public static function obtenerRegistrosPaginados($limit, $offset)
    {
        $query = "SELECT DISTINCT Id, Nombre_Negocio, Nombre_Emprendedor, Apellido1, Apellido2, Nom_Producto,
                  Num_Telefono, Correo, Imagen, Cedula, FK_Estado
                  FROM emprendedores
                  WHERE FK_Estado = 1
                  LIMIT $limit OFFSET $offset";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function getErrores()
    {
        return self::$errores;
    }

    public static function getErroresActualizar()
    {
        return self::$erroresActualizar;
    }

    public static function getErrNombNegocio()
    {
        return self::$ErrNombNegocio;
    }

    public static function getErrNombPersona()
    {
        return self::$ErrNombPersona;
    }

    public static function getErrApel()
    {
        return self::$ErrApel;
    }

    public static function getErrApell()
    {
        return self::$ErrApell;
    }

    public static function getErrNombProduct()
    {
        return self::$ErrNombProduct;
    }

    public static function getErrTel()
    {
        return self::$ErrTel;
    }

    public static function getErrCorreo()
    {
        return self::$ErrCorreo;
    }

    public static function getErrActividad()
    {
        return self::$ErrActividad;
    }

    public static function getErrImg()
    {
        return self::$ErrImg;
    }

    public static function getErrCedula()
    {
        return self::$ErrCedula;
    }

    public static function getErrEstado()
    {
        return self::$ErrEstado;
    }

    public static function getErrFeriaEmprende()
    {
        return self::$ErrFeriaEmprende;
    }

    public function validaErrNombNegocio()
    {
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre_Negocio)) {
            self::$ErrNombNegocio = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
        } elseif (empty($this->Nombre_Negocio)) {
            self::$ErrNombNegocio = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Nombre" no debe estar en blanco.</div>';
        }

        return self::$ErrNombNegocio;
    }

    public function validaErrNombPersona()
    {
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre_Emprendedor)) {
            self::$ErrNombPersona = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
        } elseif (empty($this->Nombre_Emprendedor)) {
            self::$ErrNombPersona = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Nombre" no debe estar en blanco.</div>';
        }

        return self::$ErrNombPersona;
    }

    public function validaErrApel()
    {
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Apellido1)) {
            self::$ErrApel = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
        } elseif (empty($this->Apellido1)) {
            self::$ErrApel = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Primer apellido" no debe estar en blanco.</div>';
        }

        return self::$ErrApel;
    }

    public function validaErrApell()
    {
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Apellido2)) {
            self::$ErrApell = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
        } elseif (empty($this->Apellido2)) {
            self::$ErrApell = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Segundo apellido" no debe estar en blanco.</div>';
        }

        return self::$ErrApell;
    }

    public function validaErrNombProduct()
    {
        if (!preg_match("/^([A-Za-záéíóúÁÉÍÓÚÑñ,\s]*)$/", $this->Nom_Producto)) {
            self::$ErrNombProduct = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, comas (,), acentos y espacios son permitidos.</div>';
        } elseif (empty($this->Nom_Producto)) {
            self::$ErrNombProduct = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Nombre" no debe estar en blanco.</div>';
        }

        return self::$ErrNombProduct;
    }

    public function validaErrTel()
    {
        if (preg_match("/^([A-Za-záéíóúÁÉÍÓÚÑñ,\s]*)$/", $this->Num_Telefono)) {
            self::$ErrTel = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo números son permitidos.</div>';
        } elseif (!preg_match("/^([0-9]{8})*$/", $this->Num_Telefono)) {
            self::$ErrTel = '<div style="padding-inline: 12px;"><strong>Error!</strong> Debe contener 8 números.</div>';
        } elseif (empty($this->Num_Telefono)) {
            self::$ErrTel = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Número de teléfono" no debe estar en blanco.</div>';
        }

        return self::$ErrTel;
    }

    public function validaErrCorreo()
    {
        if (!preg_match("/^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/", $this->Correo)) {
            self::$ErrCorreo = '<div style="padding-inline: 12px;"><strong>Error!</strong> Debe añadir un correo electrónico válido.</div>';
        }

        return self::$ErrCorreo;
    }

    public function validaErrActividad()
    {
        if (empty($this->FK_Tipo_Actividad)) {
            self::$ErrActividad = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Tipo de actividad" no debe estar en blanco.</div>';
        }

        return self::$ErrActividad;
    }

    public function validaErrEstado()
    {
        if (empty($this->FK_Estado)) {
            self::$ErrEstado = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Estado" no debe estar en blanco.</div>';
        }

        return self::$ErrEstado;
    }

    public function validaErrImg()
    {
        if (!$this->Imagen) {
            self::$ErrImg = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Imagen" no debe estar en blanco.</div>';
        }

        return self::$ErrImg;
    }

    public function validaErrCedula()
    {
        if (empty($this->Cedula)) {
            self::$ErrCedula = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Número de cédula" no debe estar en blanco.</div>';
        } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $this->Cedula)) {
            self::$ErrCedula = '<div style="padding-inline: 12px;"><strong>Error!</strong> No cumple con el formato 9 números.</div>';
        }

        return self::$ErrCedula;
    }

    public function validaErrFeriaEmprende()
    {
        if (empty($this->FK_feria_emprendedor)) {
            self::$ErrFeriaEmprende = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Nuevo campo" no debe estar en blanco.</div>';
        }

        return self::$ErrFeriaEmprende;
    }

    public function validar()
    {
        if ((!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre_Negocio)) || (empty($this->Nombre_Negocio)) || (!$this->Nombre_Emprendedor)
            || (!$this->Apellido1) || (!$this->Apellido2) || (!preg_match("/^([A-Za-záéíóúÁÉÍÓÚÑñ,\s]*)$/", $this->Nom_Producto)) || (!$this->Nom_Producto)
            || (!$this->FK_Estado) || (!preg_match("/^([0-9]{8})*$/", $this->Num_Telefono)) || (!$this->Num_Telefono)
            || (!preg_match("/^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/", $this->Correo)) || (!$this->Correo)
            || (!$this->FK_Tipo_Actividad) || (!$this->Imagen) || (!$this->Cedula) || (!$this->FK_feria_emprendedor)
        ) {
            self::$errores = "<strong>¡Error!</strong> Verifique que los datos ingresados sean correctos.";
        }
        return self::$errores;
    }

    public function validarActualizar()
    {
        if ((!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre_Negocio)) || (empty($this->Nombre_Negocio)) || (!$this->Nombre_Emprendedor)
            || (!$this->Apellido1) || (!$this->Apellido2) || (!preg_match("/^([A-Za-záéíóúÁÉÍÓÚÑñ,\s]*)$/", $this->Nom_Producto)) || (!$this->Nom_Producto)
            || (!$this->FK_Estado) || (!preg_match("/^([0-9]{8})*$/", $this->Num_Telefono)) || (!$this->Num_Telefono)
            || (!preg_match("/^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/", $this->Correo)) || (!$this->Correo)
            || (!$this->FK_Tipo_Actividad) || (!$this->Imagen) || (!$this->FK_feria_emprendedor)
        ) {
            self::$erroresActualizar = "<strong>Advertencia!</strong> Verifique que los datos ingresados sean correctos.";
        }
        return self::$erroresActualizar;
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
        $query = "SELECT * FROM emprendedores";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }


    public static function innerJoin()
    {
        $query = "SELECT DISTINCT 
                  e.Id, e.Nombre_Negocio, e.Nombre_Emprendedor, e.Apellido1, e.Apellido2, e.Nom_Producto,
                  em.Estado, e.Num_Telefono, e.Correo, te.Nomb_Actividad, e.Imagen, e.Cedula
                  FROM emprendedores e
                  INNER JOIN tipoactividad_emprendedor te
                  ON e.FK_Tipo_Actividad = te.Id
                  INNER JOIN estado_emprendedor em
                  ON e.FK_Estado = em.Id
                  WHERE em.Estado = 'Activo' OR em.Estado = 'Inactivo'";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function innerJoinSolicitud()
    {
        $query = "SELECT DISTINCT 
                  e.Id, e.Nombre_Negocio, e.Nombre_Emprendedor, e.Apellido1, e.Apellido2, e.Nom_Producto,
                  em.Estado, e.Num_Telefono, e.Correo, te.Nomb_Actividad, e.Imagen, e.Cedula
                  FROM emprendedores e
                  INNER JOIN tipoactividad_emprendedor te
                  ON e.FK_Tipo_Actividad = te.Id
                  INNER JOIN estado_emprendedor em
                  ON e.FK_Estado = em.Id
                  WHERE em.Estado = 'Solicitud'";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function reportPDF()
    {
        $opcion = isset($_POST['opcion']) ? $_POST['opcion'] : 'todo';

        $query = "SELECT DISTINCT 
                  e.Id, e.Nombre_Negocio, e.Nombre_Emprendedor, e.Apellido1, e.Apellido2,
                  e.Num_Telefono, e.Correo, te.Nomb_Actividad, e.Cedula
                  FROM emprendedores e
                  INNER JOIN tipoactividad_emprendedor te
                  ON e.FK_Tipo_Actividad = te.Id
                  INNER JOIN estado_emprendedor em
                  ON e.FK_Estado = em.Id
                  INNER JOIN feria_y_emprendedor fe
                  ON e.FK_feria_emprendedor = fe.Id";

        if ($opcion === 'feria') {
            $query .= " WHERE fe.NombFeriaEmprende = 'Feria' AND em.Estado = 'Activo'";
        } elseif ($opcion === 'emprendedor') {
            $query .= " WHERE fe.NombFeriaEmprende = 'Emprendedor' AND em.Estado = 'Activo'";
        } elseif ($opcion === 'todo') {
            $query .= " WHERE fe.NombFeriaEmprende = 'Feria' OR fe.NombFeriaEmprende = 'Emprendedor'";
        }

        $reportPDF = self::consultarSQL($query);

        return $reportPDF;
    }


    public static function find($Id)
    {
        $query = "SELECT * FROM emprendedores WHERE Id = $Id";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);  //torna el primer elemento de un arreglo;
    }
}
