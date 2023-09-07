<?php

namespace Model;

class Gastronomy
{

    //Base de datos
    protected static $db;
    protected static $tblgastronomia = ['Id', 'Nom_Servicio', 'Descripcion', 'Ubicacion', 'Hora_apertura', 'Hora_cierre', 'Diainicial_Id', 'Diafinal_Id', 'Contacto', 'Correo', 'Categoria_Id', 'Imagen', 'FK_Estado'];

    //Errores
    public static $errores;
    public static $ErrNombServicio;
    public static $ErrDescrip;
    public static $ErrUbi;
    public static $ErrHI;
    public static $ErrHF;
    public static $ErrDI;
    public static $ErrDF;
    public static $ErrTel;
    public static $ErrCorreo;
    public static $ErrCate;
    public static $ErrImg;
    public static $ErrEstado;

    public $Id;
    public $Nom_Servicio;
    public $Descripcion;
    public $Ubicacion;
    public $Hora_apertura;
    public $Hora_cierre;
    public $Diainicial_Id;
    public $Diafinal_Id;
    public $Contacto;
    public $Correo;
    public $Categoria_Id;
    public $Imagen;
    public $FK_Estado;
    public $Categoria_gastronomico; //inner join
    public $Nombre_Dial; //inner join
    public $Nombre_Diall; //inner join
    public $Estado; //inner join

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nom_Servicio = $args['Nom_Servicio'] ?? '';
        $this->Descripcion = $args['Descripcion'] ?? '';
        $this->Ubicacion = $args['Ubicacion'] ?? '';
        $this->Hora_apertura = $args['Hora_apertura'] ?? '';
        $this->Hora_cierre = $args['Hora_cierre'] ?? '';
        $this->Diainicial_Id = $args['Diainicial_Id'] ?? '';
        $this->Diafinal_Id = $args['Diafinal_Id'] ?? '';
        $this->Contacto = $args['Contacto'] ?? '';
        $this->Correo = $args['Correo'] ?? '';
        $this->Categoria_Id = $args['Categoria_Id'] ?? '';
        $this->Imagen = $args['Imagen'] ?? '';
        $this->FK_Estado = $args['FK_Estado'] ?? '';
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

    public function actualizar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE gastronomia SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE Id = '" . self::$db->escape_string($this->Id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function crear()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $query = " INSERT INTO gastronomia ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";


        $resultado = self::$db->query($query);

        return $resultado;
    }

    //Identifica y une las columnas de la BDs
    public function atributos()
    {
        //De esta manera los atributos se va a ir mapeando con las columnas de la BDs
        $atributos = [];
        foreach (self::$tblgastronomia as $columna) {
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
        $query = "DELETE FROM gastronomia WHERE Id = " . self::$db->escape_string($this->Id) . " LIMIT 1";
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


    //-----------------------------------------//GET---VALIDACIONES-//-----------------------------------------//
    public static function getErrores()
    {
        return self::$errores;
    }

    public static function getErrNombServicio()
    {
        return self::$ErrNombServicio;
    }

    public static function getErrDescrip()
    {
        return self::$ErrDescrip;
    }

    public static function getErrUbi()
    {
        return self::$ErrUbi;
    }

    public static function getErrHI()
    {
        return self::$ErrHI;
    }

    public static function getErrHF()
    {
        return self::$ErrHF;
    }

    public static function getErrDI()
    {
        return self::$ErrDI;
    }

    public static function getErrDF()
    {
        return self::$ErrDF;
    }

    public static function getErrTel()
    {
        return self::$ErrTel;
    }

    public static function getErrCorreo()
    {
        return self::$ErrCorreo;
    }

    public static function getErrCate()
    {
        return self::$ErrCate;
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
    public function validaErrNombServicio()
    {
        $query = "SELECT Nom_Servicio FROM gastronomia WHERE Nom_Servicio = '" . $this->Nom_Servicio . "' LIMIT 1";
        $resultado = self::consultarSQL($query);

        if ($resultado) {
            self::$ErrNombServicio = '<div style="padding-inline: 12px;"><strong>Error!</strong> Ya existe este nombre de servicio.</div>';
        } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nom_Servicio)) {
            self::$ErrNombServicio = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
        } elseif (empty($this->Nom_Servicio)) {
            self::$ErrNombServicio = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Nombre de servicio" no debe estar en blanco.</div>';
        }

        return self::$ErrNombServicio;
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

    public function validaErrHI()
    {
        if (empty($this->Hora_apertura)) {
            self::$ErrHI = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Hora de inicio" no debe estar en blanco.</div>';
        }

        return self::$ErrHI;
    }

    public function validaErrHF()
    {
        if (empty($this->Hora_cierre)) {
            self::$ErrHF = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Hora de cierre" no debe estar en blanco.</div>';
        }

        return self::$ErrHF;
    }

    public function validaErrDI()
    {
        if (empty($this->Diainicial_Id)) {
            self::$ErrDI = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Día de inicio" no debe estar en blanco.</div>';
        }

        return self::$ErrDI;
    }

    public function validaErrDF()
    {
        if (empty($this->Diafinal_Id)) {
            self::$ErrDF = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Día de cierre" no debe estar en blanco.</div>';
        }

        return self::$ErrDF;
    }

    public function validaErrTel()
    {
        if (!preg_match("/^([0-9]{8})*$/", $this->Contacto)) {
            self::$ErrTel = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo números son permitidos.</div>';
        } elseif (empty($this->Contacto)) {
            self::$ErrTel = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Número de teléfono" no debe estar en blanco.</div>';
        }

        return self::$ErrTel;
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

    public function validaErrCate()
    {
        if (empty($this->Categoria_Id)) {
            self::$ErrCate = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Tipo de lugar" no debe estar en blanco.</div>';
        }

        return self::$ErrCate;
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

    public function validar()
    {
        if ((!$this->Nom_Servicio) || (!$this->Descripcion) || (!$this->Ubicacion) || (!$this->Hora_apertura) || (!$this->Hora_cierre) || (!$this->Diainicial_Id)
            || (!$this->Diafinal_Id) || (!preg_match("/^([0-9]{8})*$/", $this->Contacto)) || (!$this->Contacto)
            || (!preg_match("/^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/", $this->Correo))
            || (!$this->Correo) || (!$this->Categoria_Id) || (!$this->Imagen)
        ) {
            self::$errores = '<strong>Advertencia!</strong> Verifique que los datos ingresados sean correctos.';
        }
        // if (!$this->Imagen) {
        //     $this->validarImagen();
        // }

        return self::$errores;
    }
    public static function get($limite)
    {
        $query = "SELECT DISTINCT g.Id, g.Nom_Servicio, g.Descripcion, g.Ubicacion, 
      g.Hora_apertura, g.Hora_cierre, dl.Nombre_Dial, dll.Nombre_Diall, 
      g.Contacto, g.Correo, cg.Categoria_gastronomico, g.Imagen 
      FROM gastronomia g
      INNER JOIN diasl dl
      ON g.Diainicial_Id = dl.Id
      INNER JOIN diasll dll
      ON g.Diafinal_Id = dll.Id
      INNER JOIN categoria_gastronomico cg
      ON g.Categoria_Id = cg.Id LIMIT ${limite}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    // public function validarImagen()
    // {
    //     if (!$this->Imagen) {
    //         self::$errores[] = 'Debe anadir una imagen';
    //     }
    // }

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
        $query = "SELECT * FROM gastronomia";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function innerJoin()
    {
        $query = "SELECT DISTINCT g.Id, g.Nom_Servicio, g.Descripcion, g.Ubicacion, 
                  g.Hora_apertura, g.Hora_cierre, g.FK_Estado, dl.Nombre_Dial, dll.Nombre_Diall, 
                  g.Contacto, g.Correo, cg.Categoria_gastronomico, g.Imagen 
                  FROM gastronomia g
                  INNER JOIN dias_gastronomia_l dl
                  ON g.Diainicial_Id = dl.Id
                  INNER JOIN dias_gastronomia_ll dll
                  ON g.Diafinal_Id = dll.Id
                  INNER JOIN categoria_gastronomico cg
                  ON g.Categoria_Id = cg.Id";

        $resultadoespacio = self::consultarSQL($query);

        return $resultadoespacio;
    }

    public static function count()
    {
        $query = "SELECT COUNT(*) AS total_datos
                  FROM (
                      SELECT DISTINCT 
                          g.Id, g.Nom_Servicio, g.Descripcion, g.Ubicacion, 
                          g.Hora_apertura, g.Hora_cierre, dl.Nombre_Dial, dll.Nombre_Diall, 
                          g.Contacto, g.Correo, cg.Categoria_gastronomico, g.Imagen 
                      FROM gastronomia g
                      INNER JOIN dias_gastronomia_l dl ON g.Diainicial_Id = dl.Id
                      INNER JOIN dias_gastronomia_ll dll ON g.Diafinal_Id = dl.Id
                      INNER JOIN categoria_gastronomico cg ON g.Categoria_Id = cg.Id
                  ) AS subconsulta";

        $resultadoespacio = self::consultarSQL($query);

        return $resultadoespacio;
    }

    public function generarPaginacion($page, $totalPages)
    {
        $pagination = '<div class="pagination">';
        $pagination .= '<ul>';

        if ($page > 1) {
            $pagination .= "<li><a href='/gastronomies?page=1'>&laquo;</a></li>";

            if ($page > 3) {
                $pagination .= "<li><span>...</span></li>";
            }
        }

        $startPage = max(1, $page - 2);
        $endPage = min($totalPages, $page + 2);

        for ($i = $startPage; $i <= $endPage; $i++) {
            $activeClass = ($i == $page) ? 'active' : '';
            $pagination .= "<li class='$activeClass'><a href='/gastronomies?page=$i'>$i</a></li>";
        }

        if ($page < $totalPages - 2) {
            $pagination .= "<li><span>...</span></li>";
        }

        if ($page < $totalPages) {
            $pagination .= "<li><a href='/gastronomies?page=$totalPages'>&raquo;</a></li>";
        }

        $pagination .= '</ul>';
        $pagination .= '</div>';

        return $pagination;
    }

    public static function obtenerTotalRegistros()
    {
        $query = "SELECT DISTINCT 
              Id, Nom_Servicio, Descripcion, Ubicacion, Hora_apertura, Hora_cierre, Contacto, 
              Correo, Imagen 
              FROM gastronomia";

        $resultado = self::consultarSQL($query);

        $totalRecords = count($resultado);

        return $totalRecords;
    }

    public static function obtenerRegistrosPaginados($limit, $offset)
    {
        $query = "SELECT DISTINCT 
              Id, Nom_Servicio, Descripcion, Ubicacion, Hora_apertura, Hora_cierre, Contacto, 
              Correo, Imagen 
              FROM gastronomia
              LIMIT $limit OFFSET $offset";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca un lugar por su id
    public static function find($Id)
    {
        $query = "SELECT * FROM gastronomia WHERE Id = $Id";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);  //torna el primer elemento de un arreglo;
    }
}
