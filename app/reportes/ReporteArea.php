<?php 

class Reporte {

    public static $con;


    public function __construct() {
        require_once './vendor/autoload.php';
    }

    public function reporteArea($codigoArea, $resultado,$resultado1) {


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

        $area = $resultado1->fetch_assoc();

        $area = $area["descArea"];

        $tabla.= "
            <div class='header'>
                <h1>Reporte de envíos del área: <font color='#85BC22'>".$area."</font></h1>
            </div>    

            <table class='tabla'>
            <tr>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Trámite</th>
                <th>Cliente</th>
                <th>Tipo de documento</th>
                <th>N° Documento</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Observación</th>
            </tr>

            ";

        while($fila = $resultado->fetch_assoc()) {
            $tabla.="<tr>
                        <td>".$fila['nomUsuario']."</td>
                        <td>".$fila['fecha']."</td>
                        <td>".$fila['hora']."</td>
                        <td>".$fila['descTipoTramite']."</td>
                        <td>".$fila['nombreCliente']."</td>
                        <td>".$fila['descTipoDocumento']."</td>
                        <td>".$fila['numDoc']."</td>
                        <td>".$fila['monto']."</td>";
                        switch ($fila['descStatus']) {
                        case 'Pendiente':
                                $tabla.="<td bgcolor='#F6AD43'>".$fila['descStatus']."</td>";
                                break;
                            
                        case 'Completo':
                                $tabla.="<td bgcolor='lightgreen'>".$fila['descStatus']."</td>";
                                    break;

                        case 'Revisado':
                                $tabla.="<td bgcolor='#F67943'>".$fila['descStatus']."</td>";
                                    break;
                        
                        case 'Regresado a Finanzas':
                                $tabla.="<td bgcolor='lightblue'>".$fila['descStatus']."</td>";
                                    break;            
                        }
                        $tabla.="<td>".$fila['observacion']."</td>
                     </tr>";
        }

        $tabla .= "</table>";

        $html = $tabla;


        $pdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $pdf->WriteHTML($html);
        $pdf->Output();

    }

}