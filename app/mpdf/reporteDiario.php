<?php

 include 'mpdf/mpdf.php';

 function datos()
 {

    $con = new mysqli("localhost","root","","deloitte_mensajeria");

    $sql="call reporteDiario();";

$res = $con ->query($sql);
$tabla="";
$tabla.= "<table border='1px'>
            <tr>
                <th>Usuario</th>
                <th>Hora</th>
                <th>Trámite</th>
                <th>Cliente</th>
                <th>Área</th>
                <th>Tipo de documento</th>
                <th>N° Documento</th>
                <th>Monto</th>
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
                <td>".$fila['monto']."</td>
                <td>".$fila['observacion']."</td>
        </tr>";
}
$tabla .= "</table>";
return $tabla;

}
 
$html = datos();


$pdf = new mPDF('c');
$pdf->WriteHTML($html);
$pdf->Output();

?>