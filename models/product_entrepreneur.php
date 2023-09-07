<?php

namespace Model;

class Product_entrepreneur
{
    protected static $db;
    protected static $tabla = ['Id', 'Nomb_Producto'];

    public static $errores = [];

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public $Id;
    public $Nomb_Producto;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nomb_Producto = $args['Nomb_Producto'] ?? '';
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
        $p_resultado = self::$db->query($query);

        //iterar el p_resultado
        $array = [];
        while ($registro = $p_resultado->fetch_assoc()) {
            //Se combierte a objeto
            $array[] = self::crearObjeto($registro);
        }

        //liberar memoria
        $p_resultado->free();

        //retornar resultado
        return $array;
    }

    public static function all()
    {
        $query = "SELECT * FROM producto_emprendedor";

        $p_resultado = self::consultarSQL($query);

        return $p_resultado;
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

        $query = " INSERT INTO producto_emprendedor ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";


        $p_resultado = self::$db->query($query);
        // return $p_resultado;

        //Mensaje de éxito y redireccionado
        if ($p_resultado) {
            header('Location: /products_entrepreneurs/create?r=1');
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

        $query = "UPDATE producto_emprendedor SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE Id = '" . self::$db->escape_string($this->Id) . "' ";
        $query .= " LIMIT 1 ";

        $p_resultado = self::$db->query($query);

        if ($p_resultado) {
            header('Location: /products_entrepreneurs/create?r=2');
        }
    }

    public function eliminar()
    {
        // Eliminar el registro
        $query = "DELETE FROM producto_emprendedor WHERE Id = " . self::$db->escape_string($this->Id) . " LIMIT 1";
        $p_resultado = self::$db->query($query);

        if ($p_resultado) {
            header('location: /products_entrepreneurs/create?r=3');
        }
    }

    public static function find($Id)
    {
        $query = "SELECT * FROM producto_emprendedor WHERE Id = ${Id}";

        $p_resultado = self::consultarSQL($query);

        return array_shift($p_resultado);  //torna el primer elemento de un arreglo;
    }

    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {
        if (!$this->Nomb_Producto) {
            self::$errores[] = "<strong>Error!.</strong> Debe anadir un nombre de producto.";
        }

        return self::$errores;
    }
}
