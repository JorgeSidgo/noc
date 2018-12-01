<?php

 include 'mpdf/mpdf.php';

 function datos()
 {

    $con = new mysqli("localhost","root","","deloitte_mensajeria");

    $sql="select e.codigoEnvio, d.codigoDetalleEnvio, u.nomUsuario, e.fecha, e.hora, tt.descTipoTramite, c.nombreCliente, a.descArea, tc.descTipoDocumento, d.numDoc, s.descStatus, d.monto, d.observacion
	from detalleEnvio d
	inner join envio e on e.codigoEnvio = d.codigoEnvio
    inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join tipoTramite tt on tt.codigoTipoTramite = d.codigoTipoTramite
	inner join clientes c on c.codigoCliente = d.codigoCliente
    inner join tipoDocumento tc on tc.codigoTipoDocumento = d.codigoTipoDocumento
    inner join area a on a.codigoArea = d.codigoArea 
    inner join status s on s.codigoStatus = d.codigoStatus
where e.fecha=(select Max(fecha) from envio) order by e.hora DESC;";

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