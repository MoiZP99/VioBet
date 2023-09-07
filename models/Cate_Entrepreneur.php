<?php

namespace Model;

class Cate_Entrepreneur
{
    protected static $db;
    protected static $tabla = ['Id', 'Nomb_Actividad'];

    public static $errores;

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public $Id;
    public $Nomb_Actividad;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nomb_Actividad = $args['Nomb_Actividad'] ?? '';
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
        $resultadocategoria = self::$db->query($query);

        //iterar el resultado
        $array = [];
        while ($registro = $resultadocategoria->fetch_assoc()) {
            //Se combierte a objeto
            $array[] = self::crearObjeto($registro);
        }

        //liberar memoria
        $resultadocategoria->free();

        //retornar resultado
        return $array;
    }

    public static function all()
    {
        $query = "SELECT Id, Nomb_Actividad FROM tipoactividad_emprendedor";

        $resultadocategoria = self::consultarSQL($query);

        return $resultadocategoria;
    }

    public function atributos()
    {
        //De esta manera los atributos se va a ir mapeando con las columnas de la BDs
        $atributos = [];
        foreach (self::$tabla as $columna) {
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

        $query = " INSERT INTO tipoactividad_emprendedor ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";


        $resultado = self::$db->query($query);
        // return $resultado;

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

        $query = "UPDATE tipoactividad_emprendedor SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE Id = '" . self::$db->escape_string($this->Id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function eliminar()
    {
        // Eliminar el registro
        $query = "DELETE FROM tipoactividad_emprendedor WHERE Id = " . self::$db->escape_string($this->Id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function find($Id)
    {
        $query = "SELECT * FROM tipoactividad_emprendedor WHERE Id = ${Id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);  //torna el primer elemento de un arreglo;
    }

    public static function getErrores()
    {
        return self::$errores;
    }


    public function validar()
    {
        $query = "SELECT Nomb_Actividad FROM tipoactividad_emprendedor WHERE Nomb_Actividad LIKE '%" . $this->Nomb_Actividad . "%' LIMIT 1";
        $resultado = self::consultarSQL($query);

        if ($resultado) {
            self::$errores = '<div style="padding-inline: 12px;"><strong>Error!</strong> Esta categoría ya se encuentra registrada.</div>';
        } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]*$/", $this->Nomb_Actividad)) {
            self::$errores = '<div style="padding-inline: 12px;"><strong>Error!</strong> Solo letras, acentos y espacios son permitidos.</div>';
        } elseif (empty($this->Nomb_Actividad)) {
            self::$errores = '<div style="padding-inline: 12px;"><strong>Error!</strong> "Categoría" no debe estar en blanco.</div>';
        }

        return self::$errores;
    }
}
