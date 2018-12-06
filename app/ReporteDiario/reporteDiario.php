<?php

 require_once './vendor/autoload.php';

 function datos()
 {

    $con = new mysqli("localhost","root","","deloitte_mensajeria");

    $sql="call reporteDiario();";
    
$res = $con ->query($sql);

$tabla="";

$tabla .= '<style>
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
                

$tabla.= "
            <div class='header'>
                <h1>Envíos Deloitte<font color='#85BC22' size='100px'>.</font></h1>
                <p>Fecha: <b>".$fecha['fecha']."</b></p>
            </div>    

            <table class='tabla'>
            <tr>
                <th>Usuario</th>
                <th>Hora</th>
                <th>Trámite</th>
                <th>Cliente</th>
                <th>Área</th>
                <th>Tipo de documento</th>
                <th>N° Documento</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Observación</th>
            </tr>

            ";
            while($fila =$res->fetch_assoc()){
$tabla.="<tr>
                <td>".$fila['nomUsuario']."</td>
                <td>".$fila['hora']."</td>
                <td>".$fila['descTipoTramite']."</td>
                <td>".$fila['nombreCliente']."</td>
                <td>".$fila['descArea']."</td>
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
return $tabla;

}
 
$html = datos();


$pdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$pdf->WriteHTML($html);
$pdf->Output();

?>