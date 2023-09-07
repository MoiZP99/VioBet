<?php

namespace Model;

class Type_Gastronomy
{
    protected static $db;
    protected static $tblTGastronomia = ['Id', 'Nom_tipo'];

    public static $errores = [];

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public $Id;
    public $Nom_tipo;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nom_tipo = $args['Nom_tipo'] ?? '';
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

    public static function allTipoGastronomia()
    {
        $query = "SELECT * FROM tipo_gastronomia";

        $resultadocategoria = self::consultarSQL($query);

        return $resultadocategoria;
    }
}
