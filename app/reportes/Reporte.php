<?php 

class Reporte {


    public function __construct() {
        require_once './vendor/autoload.php';

        $con = new Conexion();
    }

    public function reporteArea($codigoArea) {

        $query = "call reporteArea({$codigoArea})";

        $resultado = self::$con->ejecutar($query);


        $tabla = '';

        $tabla .= ' <style>
                        td { 
                            text-align: center;
                        }
                        table {
                            width: 100%;
                        }
                        .header {
                            font-family: sans-serif;
                            width: 100%;
                            display: flex;
                            justify-content: flex-end;
                        }
                        .tabla, th, td{
                            border: 1px solid black;
                            border-collapse: collapse;
                            font-family: sans-serif;
                        }
                    </style>';

    }

}