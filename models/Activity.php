<?php

namespace Model;

class Activity
{

    //Base de datos
    protected static $db;
    protected static $tblActividad = ['Id', 'Nombre_Actividad', 'Numero_Contacto', 'Hora_Inicio', 'Hora_Fin', 'Descripcion', 'Estado_Id', 'Edad_Id', 'Correo', 'Tipo_Actividad', 'Ubicacion', 'DiaInicio_Id', 'Imagen'];

    //Errores
    public static $errores;
    public static $ErrNombActivity;
    public static $ErrTel;
    public static $ErrHI;
    public static $ErrHF;
    public static $ErrDescrip;
    public static $ErrEdad;
    public static $ErrCorreo;
    public static $ErrActividad;
    public static $ErrUbi;
    public static $ErrImg;
    public static $ErrEstado;
    public static $erroresActualizar;

    public $Id;
    public $Nombre_Actividad;
    public $Numero_Contacto;
    public $Hora_Inicio;
    public $Hora_Fin;
    public $Descripcion;
    public $Estado_Id;
    public $Edad_Id;
    public $Correo;
    public $Tipo_Actividad;
    public $Ubicacion;
    public $DiaInicio_Id;
    public $Imagen;
    public $Edad; //join
    public $Estado; //join
    public $Nombre_Dia; //join

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre_Actividad = $args['Nombre_Actividad'] ?? '';
        $this->Numero_Contacto = $args['Numero_Contacto'] ?? '';
        $this->Hora_Inicio = $args['Hora_Inicio'] ?? '';
        $this->Hora_Fin = $args['Hora_Fin'] ?? '';
        $this->Descripcion = $args['Descripcion'] ?? '';
        $this->Estado_Id = $args['Estado_Id'] ?? '';
        $this->Edad_Id = $args['Edad_Id'] ?? '';
        $this->Correo = $args['Correo'] ?? '';
        $this->Tipo_Actividad = $args['Tipo_Actividad'] ?? '';
        $this->Ubicacion = $args['Ubicacion'] ?? '';
        $this->DiaInicio_Id = $args['DiaInicio_Id'] ?? '';
        $this->Imagen = $args['Imagen'] ?? '';
    }

    //Definir la conexion de la BDs
    public static function setDB($database)
    {
        self::$db = $database;
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

        $query = " INSERT INTO actividades ( ";
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

        $query = "UPDATE actividades SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE Id = '" . self::$db->escape_string($this->Id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    //Identifica y une las columnas de la BDs
    public function atributos()
    {
        //De esta manera los atributos se va a ir mapeando con las columnas de la BDs
        $atributos = [];
        foreach (self::$tblActividad as $columna) {
            if ($columna === 'Id') continue;
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

    //Esto es porque las imagenes no se envían por POST, si no por  FILES
    //subida de archivos
    public function setImagen($Imagen)
    {
        //Este es el método de  borrarImagen, Se pone ebajo y no aquí para no repétir código
        // $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        // if($existeArchivo) {
        //     unlink(CARPETA_IMAGENES . $this->imagen);
        // }


        // Elimina la imagen previa
        if (!is_null($this->Id)) {
            $this->borrarImagen(); //El codigo de este metodo no se pone aquí para no diplicar codigo
        }

        //Asigna el atributo imagen al nombre de la imagen, para tener la referencia y guardarla en la BDs
        if ($Imagen) {
            $this->Imagen = $Imagen;
        }
    }

    // Eliminar un registro
    public function eliminar()
    {
        // Eliminar el registro
        $query = "DELETE FROM actividades WHERE Id = " . self::$db->escape_string($this->Id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
        }

        return $resultado;
    }

    // Elimina el archivo
    public function borrarImagen()
    {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->Imagen); //Se hace eso porque tienme la referencia en el objetp y nunca se va a perder
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->Imagen);
        }
    }

    public static function get($limite)
    {
        $query = "SELECT Id, Nombre_Actividad, Numero_Contacto, Hora_Inicio, Hora_Fin, Descripcion, Estado_Id,
                  Estado_Id, Correo, Tipo_Actividad, Ubicacion, Imagen
                  FROM actividades
                  WHERE Estado_Id = 1
                  LIMIT $limite";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //-----------------------------------------//GET---VALIDACIONES-//-----------------------------------------//
    public static function getErrores()
    {
        return self::$errores;
    }

    public static function getErroresActualizar()
    {
        return self::$erroresActualizar;
    }

    public static function getErrNombActivity()
    {
        return self::$ErrNombActivity;
    }

    public static function getErrTel()
    {
        return self::$ErrTel;
    }

    public static function getErrHI()
    {
        return self::$ErrHI;
    }

    public static function getErrHF()
    {
        return self::$ErrHF;
    }

    public static function getErrDescrip()
    {
        return self::$ErrDescrip;
    }

    public static function getErrEdad()
    {
        return self::$ErrEdad;
    }

    public static function getErrCorreo()
    {
        return self::$ErrCorreo;
    }

    public static function getErrActividad()
    {
        return self::$ErrActividad;
    }

    public static function getErrUbi()
    {
        return self::$ErrUbi;
    }

    public static function getErrImg()
    {
        return self::$ErrImg;
    }

    public static function getErrEstado()
    {
        return self::$ErrEstado;
    }

    //-----------------------------------------//-VALIDACIONES-//-----------------------------------------//
    public function validaErrNombNegocio()
    {
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nombre_Actividad)) {
            self::$ErrNombActivity = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
        } elseif (empty($this->Nombre_Actividad)) {
            self::$ErrNombActivity = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Nombre" no debe estar en blanco.</div>';
        }

        return self::$ErrNombActivity;
    }

    public function validaErrTel()
    {
        if (!preg_match("/^([0-9]{8})*$/", $this->Numero_Contacto)) {
            self::$ErrTel = '<div style="padding-inline: 12px;"><strong>Error!</strong> Debe ingresar 8 números.</div>';
        } elseif (empty($this->Numero_Contacto)) {
            self::$ErrTel = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Número de teléfono" no debe estar en blanco.</div>';
        }

        return self::$ErrTel;
    }

    public function validaErrHI()
    {
        if (empty($this->Hora_Inicio)) {
            self::$ErrHI = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Hora de inicio" no debe estar en blanco.</div>';
        }

        return self::$ErrHI;
    }

    public function validaErrHF()
    {
        if (empty($this->Hora_Fin)) {
            self::$ErrHF = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Hora de cierre" no debe estar en blanco.</div>';
        }

        return self::$ErrHF;
    }

    public function validaErrDescrip()
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

    public function validaErrEdad()
    {
        if (empty($this->Hora_Fin)) {
            self::$ErrEdad = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Tipo de persona" no debe estar en blanco.</div>';
        }

        return self::$ErrEdad;
    }

    public function validaErrCorreo()
    {
        if (empty($this->Correo)) {
            self::$ErrCorreo = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Correo electrónico" no debe estar en blanco.</div>';
        } elseif (!preg_match("/^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/", $this->Correo)) {
            self::$ErrCorreo = '<div style="padding-inline: 12px;"><strong>Error!</strong> Debe añadir un correo electrónico válido.</div>';
        }

        return self::$ErrCorreo;
    }

    public function validaErrActividad()
    {
        if (empty($this->Hora_Inicio)) {
            self::$ErrActividad = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Tipo de actividad" no debe estar en blanco.</div>';
        }

        return self::$ErrActividad;
    }

    public function validaErrUbi()
    {
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Ubicacion)) {
            self::$ErrUbi = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
        } elseif (empty($this->Ubicacion)) {
            self::$ErrUbi = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Ubicación" no debe estar en blanco.</div>';
        }

        return self::$ErrUbi;
    }

    public function validaErrImg()
    {
        if (!$this->Imagen) {
            self::$ErrImg = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Imagen" no debe estar en blanco.</div>';
        }

        return self::$ErrImg;
    }

    public function validaErrEstado()
    {
        if (empty($this->Estado_Id)) {
            self::$ErrEstado = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Estado" no debe estar en blanco.</div>';
        }

        return self::$ErrEstado;
    }

    public function validar()
    {
        if ((!$this->Nombre_Actividad) || (!preg_match("/^([0-9]{8})*$/", $this->Numero_Contacto)) || (!$this->Numero_Contacto)
            || (!$this->Hora_Inicio) || (!$this->Hora_Fin) || (!$this->Descripcion) || (!$this->Edad_Id)
            || (!preg_match("/^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/", $this->Correo)) || (!$this->Correo)
            || (!$this->Tipo_Actividad) || (!$this->Ubicacion) || (!$this->Imagen) || (!$this->Estado_Id) || (!$this->Estado_Id)
        ) {
            self::$errores = '<strong>Advertencia!</strong> Verifique que los datos ingresados sean correctos.';
        }
        return self::$errores;
    }

    public function validarActualizar()
    {
        if ((!$this->Nombre_Actividad) || (!preg_match("/^([0-9]{8})*$/", $this->Numero_Contacto)) || (!$this->Numero_Contacto)
            || (!$this->Hora_Inicio) || (!$this->Hora_Fin) || (!$this->Descripcion) || (!$this->Edad_Id)
            || (!preg_match("/^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/", $this->Correo)) || (!$this->Correo)
            || (!$this->Tipo_Actividad) || (!$this->Ubicacion) || (!$this->Estado_Id) || (!$this->Estado_Id)
        ) {
            self::$erroresActualizar = '<strong>Advertencia!</strong> Verifique que los datos ingresados sean correctos.';
        }
        return self::$erroresActualizar;
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
        //Escribir el query
        // $query = "SELECT lg.id, lg.nombre_lugar, lg.numero_contacto, lg.descripcion, lg.correo, lg.imagen, lg.tipo_espacio, 
        //                  lg.hora_clausura, lg.hora_apertura , lg.dia_clausura, lg.dia_apertura, lg.ubicacion, lg.categoria_Id
        //           FROM" . static::$tabla . "lg";

        $query = "SELECT * FROM actividades";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function innerJoin()
    {
        $query = "SELECT a.Id, a.Nombre_Actividad, a.Numero_Contacto, a.Hora_Inicio, a.Hora_Fin, a.Descripcion, a.Estado_Id,
                  a.Estado_Id, a.Correo, a.Tipo_Actividad, a.Ubicacion, a.Imagen, e.Estado, ed.Edad, de.Nombre_Dia
                  FROM actividades a
                  INNER JOIN estado_emprendedor e
                  ON a.Estado_Id = e.Id
                  INNER JOIN edad ed
                  ON a.Edad_Id = ed.Id
                  INNER JOIN dias_actividad de
                  ON a.DiaInicio_Id = de.Id";

        $resultadoespacio = self::consultarSQL($query);

        return $resultadoespacio;
    }

    public static function joinOnlyActive()
    {
        $query = "SELECT a.Id, a.Nombre_Actividad, a.Numero_Contacto, a.Hora_Inicio, a.Hora_Fin, a.Descripcion, a.Estado_Id,
                  a.Estado_Id, a.Correo, a.Tipo_Actividad, a.Ubicacion, a.Imagen, e.Estado, ed.Edad, de.Nombre_Dia
                  FROM actividades a
                  INNER JOIN estado_emprendedor e
                  ON a.Estado_Id = e.Id
                  INNER JOIN edad ed
                  ON a.Edad_Id = ed.Id
                  INNER JOIN dias_actividad de
                  ON a.DiaInicio_Id = de.Id
                  WHERE Estado_Id = 1";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function count()
    {
        $query = "SELECT COUNT(*) AS total_datos
                  FROM (
                      SELECT a.Id, a.Nombre_Actividad, a.Numero_Contacto, a.Hora_Inicio, a.Hora_Fin, a.Descripcion,
                          a.Estado_Id, a.Correo, a.Tipo_Actividad, a.Ubicacion, a.Imagen, e.Estado, ed.Edad, de.Nombre_Dia
                      FROM actividades a
                      INNER JOIN estado_emprendedor e ON a.Estado_Id = e.Id
                      INNER JOIN edad ed ON a.Edad_Id = ed.Id
                      INNER JOIN dias_actividad de ON a.DiaInicio_Id = de.Id
                  ) AS subconsulta";

        $resultadoespacio = self::consultarSQL($query);

        return $resultadoespacio;
    }

    public function generarPaginacion($page, $totalPages)
    {
        $pagination = '<div class="pagination">';
        $pagination .= '<ul>';

        if ($page > 1) {
            $pagination .= "<li><a href='/activities?page=1'>&laquo;</a></li>";

            if ($page > 3) {
                $pagination .= "<li><span>...</span></li>";
            }
        }

        $startPage = max(1, $page - 2);
        $endPage = min($totalPages, $page + 2);

        for ($i = $startPage; $i <= $endPage; $i++) {
            $activeClass = ($i == $page) ? 'active' : '';
            $pagination .= "<li class='$activeClass'><a href='/activities?page=$i'>$i</a></li>";
        }

        if ($page < $totalPages - 2) {
            $pagination .= "<li><span>...</span></li>";
        }

        if ($page < $totalPages) {
            $pagination .= "<li><a href='/activities?page=$totalPages'>&raquo;</a></li>";
        }

        $pagination .= '</ul>';
        $pagination .= '</div>';

        return $pagination;
    }

    public static function obtenerTotalRegistros()
    {
        $query = "SELECT a.Id, a.Nombre_Actividad, a.Numero_Contacto, a.Hora_Inicio, a.Hora_Fin, a.Descripcion, a.Estado_Id,
                  a.Estado_Id, a.Correo, a.Tipo_Actividad, a.Ubicacion, a.Imagen, e.Estado, ed.Edad, de.Nombre_Dia
                  FROM actividades a
                  INNER JOIN estado_emprendedor e
                  ON a.Estado_Id = e.Id
                  INNER JOIN edad ed
                  ON a.Edad_Id = ed.Id
                  INNER JOIN dias_actividad de
                  ON a.DiaInicio_Id = de.Id
                  WHERE Estado_Id = 1";

        $resultado = self::consultarSQL($query);

        $totalRecords = count($resultado);

        return $totalRecords;
    }

    public static function obtenerRegistrosPaginados($limit, $offset)
    {
        $query = "SELECT a.Id, a.Nombre_Actividad, a.Numero_Contacto, a.Hora_Inicio, a.Hora_Fin, a.Descripcion, a.Estado_Id,
                  a.Estado_Id, a.Correo, a.Tipo_Actividad, a.Ubicacion, a.Imagen, e.Estado, ed.Edad, de.Nombre_Dia
                  FROM actividades a
                  INNER JOIN estado_emprendedor e
                  ON a.Estado_Id = e.Id
                  INNER JOIN edad ed
                  ON a.Edad_Id = ed.Id
                  INNER JOIN dias_actividad de
                  ON a.DiaInicio_Id = de.Id
                  WHERE Estado_Id = 1
                  LIMIT $limit OFFSET $offset";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca un lugar por su id
    public static function find($Id)
    {
        $query = "SELECT Id, Nombre_Actividad, Numero_Contacto, Hora_Inicio, Hora_Fin, Descripcion, Estado_Id,
        Estado_Id, Correo, Tipo_Actividad, Ubicacion, Imagen
        FROM actividades
        WHERE Id = $Id";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);  //torna el primer elemento de un arreglo;
    }
}
