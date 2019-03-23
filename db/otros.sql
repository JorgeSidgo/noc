use deloitte_mensajeria;

drop procedure reporteDiario;

delimiter $$
create procedure reporteDiario()
begin
select e.codigoEnvio, d.codigoDetalleEnvio, d.correlativoDetalle, u.nomUsuario, DATE_FORMAT(d.fechaRevision,'%d/%m/%Y') as fechaRevision, d.horaRevision, DATE_FORMAT(d.fechaRegistro,'%d/%m/%Y') as  fechaRegistro, e.hora as horaRegistro, tt.descTipoTramite, c.nombreCliente, a.descArea, tc.descTipoDocumento, d.numDoc, s.descStatus, d.monto, d.observacion
	from detalleEnvio d
	inner join envio e on e.codigoEnvio = d.codigoEnvio
    inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join tipoTramite tt on tt.codigoTipoTramite = d.codigoTipoTramite
	inner join clientes c on c.codigoCliente = d.codigoCliente
    inner join tipoDocumento tc on tc.codigoTipoDocumento = d.codigoTipoDocumento
    inner join area a on a.codigoArea = d.codigoArea 
    inner join status s on s.codigoStatus = d.codigoStatus
 where fechaRevision=CURDATE() and (s.descStatus='Completo' or s.descStatus='Pendiente')  order by fecha DESC;
end
$$
