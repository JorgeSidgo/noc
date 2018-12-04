drop database if exists deloitte_mensajeria;
create database deloitte_mensajeria;
use deloitte_mensajeria;

-- ===========================================================================
-- TABLAS
-- ===========================================================================

create table usuario (
    codigoUsuario int primary key unique auto_increment,
    nombre varchar(50),
    apellido varchar(50),
    nomUsuario varchar(75),
    email varchar(100),
    pass varchar(75),
    codigoAuth int,
    codigoRol int,
    codigoArea int
);

create table rol (
    codigoRol int primary key unique auto_increment,
    descRol varchar(25)
);

create table area (
	codigoArea int primary key unique auto_increment,
    descArea varchar(25)
);

create table authUsuario (
	codigoAuth int primary key unique auto_increment,
    descAuth varchar(25)
);

create table envio (
	codigoEnvio int primary key unique auto_increment,
    codigoUsuario int,
    fecha date,
    hora time 
);

create table detalleEnvio (
	codigoDetalleEnvio int primary key unique auto_increment,
    codigoEnvio int,
    codigoTipoTramite int,
    codigoCliente int,
    codigoTipoDocumento int,
    codigoArea int,
    codigoStatus int,
    numDoc varchar(25),
    monto varchar(25),
    observacion text
);

create table tipoTramite(
	codigoTipoTramite int primary key unique auto_increment,
    descTipoTramite varchar(25)
);

create table clientes (
	codigoCliente int primary key unique auto_increment,
    nombreCliente varchar(50),
    direccion varchar(100),
    telefono varchar(20)
);

create table tipoDocumento (
    codigoTipoDocumento int primary key unique auto_increment,
    descTipoDocumento varchar(25)
);

create table observaciones (
    codigoObservaciones int primary key unique auto_increment,
    observacion text
);

create table status (
    codigoStatus int primary key unique auto_increment,
    descStatus varchar(25)
);

-- ===========================================================================
-- RELACIONES
-- ===========================================================================

alter table usuario add constraint fk_usuario_rol foreign key (codigoRol) references rol(codigoRol);
alter table usuario add constraint fk_usuario_auth foreign key (codigoAuth) references authUsuario(codigoAuth);
alter table usuario add constraint fk_usuario_area foreign key (codigoArea) references area(codigoArea);
alter table envio add constraint fk_envio_usuario foreign key (codigoUsuario) references usuario(codigoUsuario);
alter table detalleEnvio add constraint fk_detalleEnvio_envio foreign key (codigoEnvio) references envio(codigoEnvio);
alter table detalleEnvio add constraint fk_detalleEnvio_tipoTramite foreign key (codigoTipoTramite) references tipoTramite(codigoTipoTramite);
alter table detalleEnvio add constraint fk_detalleEnvio_tipoDocumento foreign key (codigoTipoDocumento) references tipoDocumento(codigoTipoDocumento);
alter table detalleEnvio add constraint fk_detalleEnvio_area foreign key (codigoArea) references area(codigoArea);
alter table detalleEnvio add constraint fk_detalleEnvio_clientes foreign key (codigoCliente) references clientes(codigoCliente);
-- alter table detalleEnvio add constraint fk_detalleEnvio_observaciones foreign key (codigoObservaciones) references observaciones(codigoObservaciones);
alter table detalleEnvio add constraint fk_detalleEnvio_status foreign key (codigoStatus) references status(codigoStatus);


delimiter $$
create procedure registrarUsuario(
	in nom varchar(50),
    in ape varchar(50),
    in us varchar(50),
    in correo varchar(75),
    in contra varchar(75),
    in idArea int,
    in rol int
)
begin
	insert into usuario values (null, nom, ape, us, correo, contra, 2, rol, idArea);
end
$$

delimiter $$
create procedure login(
	in user varchar(50),
    in contra varchar(75)
)
begin
	select u.*, r.descRol, a.descAuth, ar.descArea
	from usuario u
	inner join rol r on r.codigoRol = u.codigoRol
	inner join authUsuario a on a.codigoAuth = u.codigoAuth
    inner join area ar on ar.codigoArea = u.codigoArea
    where u.nomUsuario = user and u.pass = contra;
end	
$$

delimiter $$
create procedure editarUsuario(
	in nom varchar(50),
    in ape varchar(50),
    in us varchar(50),
    in correo varchar(75),
    in rol int,
    in idArea int,
    in idUser int
)
begin
	update usuario
    set nombre = nom, apellido = ape, nomUsuario = us, email = correo, codigoRol = rol, codigoArea = idArea
    where codigoUsuario = idUser;
end
$$

delimiter $$
create procedure mostrarUsuarios()
begin
	select u.*, r.descRol, a.descAuth, ar.descArea
	from usuario u
	inner join rol r on r.codigoRol = u.codigoRol
	inner join authUsuario a on a.codigoAuth = u.codigoAuth
    inner join area ar on ar.codigoArea = u.codigoArea;
end
$$


#Procedimientos de Clientes

delimiter $$
create procedure mostrarClientes()
begin
	select * from clientes;
end
$$

delimiter $$
create procedure registrarCliente(
	in nom varchar(50),
    in direc varchar(50),
    in tel varchar(50)
)
begin
	insert into clientes values (null, nom, direc, tel);
end
$$

delimiter $$
create procedure editarCliente(
	in nom varchar(50),
    in direc varchar(50),
    in tel varchar(50),
    in idCliente int
)
begin
	update clientes
    set nombreCliente = nom, direccion = direc, telefono = tel
    where codigoCliente = idCliente;
end
$$
-- PROCEDIMIENTOS DOCUMENTO--
delimiter $$
create procedure mostrarDocumentos()
begin
	select * from tipoDocumento;
end
$$

delimiter $$
create procedure registrarDocumentos(
	in nom varchar(50)
)
begin
	insert into tipoDocumento values (null, nom);
end
$$

delimiter $$
create procedure editarDocumento(
	in nom varchar(50),
    in idDocumento int
)
begin
	update tipoDocumento
    set descTipoDocumento = nom
    where codigoTipoDocumento = idDocumento;
end
$$

-- PROCEDIMIENTOS AREAS--
delimiter $$
create procedure mostrarArea()
begin
	select * from area;
end
$$


delimiter $$
create procedure registrarArea(
	in descArea varchar(50)
)
begin
	insert into area values (null,descArea);
end
$$

delimiter $$
create procedure editarArea(
	in nom varchar(50),
    in idArea int
)
begin
	update area
    set descArea = nom
    where codigoArea = idArea;
end
$$


-- PROCEDIMIENTOS ENVIOS--	
delimiter $$
create procedure encabezadoEnvio(
	in usuario int
)
begin
	insert into envio values(null, usuario, curdate(), DATE_FORMAT(NOW( ), "%H:%i:%s" ));    
    select max(codigoEnvio) as codigoEnvio from envio;
end
$$
delimiter $$
create procedure registrarDetalleEnvio(
	in envio int,
    in tramite int,
    in cliente int,
    in documento int,
    in area int,
    in mon varchar(25),
    in obs text,
    in num varchar(25)
)
begin
	insert into detalleEnvio values (null, envio, tramite, cliente, documento, area, 1, num, mon, obs);
end
$$

delimiter $$
create procedure enviosPendientes()
begin
	select e.codigoEnvio, d.codigoDetalleEnvio, u.nomUsuario, e.fecha, e.hora, tt.descTipoTramite, c.nombreCliente, tc.descTipoDocumento, a.descArea, s.descStatus, d.monto, d.observacion
	from detalleEnvio d
	inner join envio e on e.codigoEnvio = d.codigoEnvio
    inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join tipoTramite tt on tt.codigoTipoTramite = d.codigoTipoTramite
	inner join clientes c on c.codigoCliente = d.codigoCliente
    inner join tipoDocumento tc on tc.codigoTipoDocumento = d.codigoTipoDocumento
    inner join area a on a.codigoArea = d.codigoArea 
    inner join status s on s.codigoStatus = d.codigoStatus
    
    where s.codigoStatus = 1;
    
end
$$

delimiter $$
create procedure detallesEnvio(
	in idEnvio int
)
begin
	select e.codigoEnvio, d.codigoDetalleEnvio, u.nomUsuario, e.fecha, e.hora, tt.descTipoTramite, c.nombreCliente, a.descArea, tc.descTipoDocumento, d.numDoc, s.descStatus, d.monto, d.observacion
	from detalleEnvio d
	inner join envio e on e.codigoEnvio = d.codigoEnvio
    inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join tipoTramite tt on tt.codigoTipoTramite = d.codigoTipoTramite
	inner join clientes c on c.codigoCliente = d.codigoCliente
    inner join tipoDocumento tc on tc.codigoTipoDocumento = d.codigoTipoDocumento
    inner join area a on a.codigoArea = d.codigoArea 
    inner join status s on s.codigoStatus = d.codigoStatus
    
    where s.codigoStatus = 1 and e.codigoEnvio = idEnvio
    
    order by d.codigoDetalleEnvio desc;
end
$$

delimiter $$
create procedure detallesEnvioLabel
(
	in idEnvio int
)
begin
	select e.codigoEnvio, d.codigoDetalleEnvio,s.descStatus
	from detalleEnvio d
	inner join envio e on e.codigoEnvio = d.codigoEnvio
    inner join status s on s.codigoStatus = d.codigoStatus
    
    where e.codigoEnvio = idEnvio
    
    order by d.codigoDetalleEnvio desc;
end
$$


delimiter $$
create procedure getEncabezadoEnvio(
	in idEnvio int
)
begin
	select e.codigoEnvio, DATE_FORMAT(e.fecha,'%d/%m/%Y') as fecha, e.hora, u.nomUsuario, u.nombre, u.apellido
    from envio e
    inner join usuario u on u.codigoUsuario = e.codigoUsuario
    where e.codigoEnvio = idEnvio;
end
$$


delimiter $$
create procedure mostrarPaquetes()
begin
	select Distinct(e.codigoEnvio), DATE_FORMAT(e.fecha,'%d/%m/%Y') as fecha, e.hora, u.nomUsuario, u.nombre, u.apellido from envio e
	inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join detalleEnvio d on e.codigoEnvio = d.codigoEnvio
	where d.codigoStatus=1 or d.codigoStatus = 2
    order by e.codigoEnvio desc;
end
$$


-- select * from detalleEnvio;

-- call detallesEnvioLabel(1);
delimiter $$ 
create procedure historialEnvios()
begin
	select Distinct(e.codigoEnvio), DATE_FORMAT(e.fecha,'%d/%m/%Y') as fecha, e.hora, u.nomUsuario, u.nombre, u.apellido from envio e
	inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join detalleEnvio d on e.codigoEnvio = d.codigoEnvio;
end
$$


delimiter $$
create procedure detallesEnvioH(
	in idEnvio int
)
begin
	select e.codigoEnvio, d.codigoDetalleEnvio, u.nomUsuario, e.fecha, e.hora, tt.descTipoTramite, c.nombreCliente, a.descArea, tc.descTipoDocumento, d.numDoc, s.descStatus, d.monto, d.observacion
	from detalleEnvio d
	inner join envio e on e.codigoEnvio = d.codigoEnvio
    inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join tipoTramite tt on tt.codigoTipoTramite = d.codigoTipoTramite
	inner join clientes c on c.codigoCliente = d.codigoCliente
    inner join tipoDocumento tc on tc.codigoTipoDocumento = d.codigoTipoDocumento
    inner join area a on a.codigoArea = d.codigoArea 
    inner join status s on s.codigoStatus = d.codigoStatus
    
    where e.codigoEnvio = idEnvio;
end
$$

delimiter $$
create procedure actualizarDetalle(
	in idDetalle int,
    in idStatus int,
    in obs text
)
begin 
	update detalleEnvio 
    set codigoStatus = idStatus, observacion = obs
    where codigoDetalleEnvio = idDetalle;
end
$$

delimiter $$
create procedure misEnvios(
	in idUsuario int
)
begin
	select Distinct(e.codigoEnvio), DATE_FORMAT(e.fecha,'%d/%m/%Y') as fecha, e.hora
    from envio e		
	inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join detalleEnvio d on e.codigoEnvio = d.codigoEnvio
	where u.codigoUsuario = idUsuario
    order by e.codigoEnvio desc;
end 
$$

delimiter $$
create procedure misDocumentosPendientes(
	in idUsuario int 
)
begin
		select e.codigoEnvio, d.codigoDetalleEnvio, u.nomUsuario, e.fecha, e.hora, tt.descTipoTramite, c.nombreCliente, a.descArea, tc.descTipoDocumento, d.numDoc, s.descStatus, d.monto, d.observacion
	from detalleEnvio d
	inner join envio e on e.codigoEnvio = d.codigoEnvio
    inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join tipoTramite tt on tt.codigoTipoTramite = d.codigoTipoTramite
	inner join clientes c on c.codigoCliente = d.codigoCliente
    inner join tipoDocumento tc on tc.codigoTipoDocumento = d.codigoTipoDocumento
    inner join area a on a.codigoArea = d.codigoArea 
    inner join status s on s.codigoStatus = d.codigoStatus
    
    where s.codigoStatus = 4 or s.codigoStatus = 2 and e.codigoUsuario = idUsuario
    
    order by d.codigoDetalleEnvio desc;
end
$$

delimiter $$
create procedure reporteDiario()
begin
select e.codigoEnvio, d.codigoDetalleEnvio, u.nomUsuario, DATE_FORMAT(e.fecha,'%d/%m/%Y') as fecha, e.hora, tt.descTipoTramite, c.nombreCliente, a.descArea, tc.descTipoDocumento, d.numDoc, s.descStatus, d.monto, d.observacion
	from detalleEnvio d
	inner join envio e on e.codigoEnvio = d.codigoEnvio
    inner join usuario u on u.codigoUsuario = e.codigoUsuario
	inner join tipoTramite tt on tt.codigoTipoTramite = d.codigoTipoTramite
	inner join clientes c on c.codigoCliente = d.codigoCliente
    inner join tipoDocumento tc on tc.codigoTipoDocumento = d.codigoTipoDocumento
    inner join area a on a.codigoArea = d.codigoArea 
    inner join status s on s.codigoStatus = d.codigoStatus
where e.fecha=(select curdate()) order by e.hora DESC;
end
$$

delimiter $$
create procedure tiposTramiteUsuario(
in idUsuario int
)
begin
select count(tt.codigoTipoTramite) as Tramite, tt.descTipoTramite  from detalleEnvio d
inner join tipoTramite tt on tt.codigoTipoTramite = d.codigoTipoTramite
inner join envio e on e.codigoEnvio = d.codigoEnvio
where e.codigoUsuario=idUsuario
group by tt.descTipoTramite;
end
$$

delimiter $$
create procedure clientes_Usuario(
in idUsuario int
)
begin
select count(c.codigoCliente) as Cliente, c.nombreCliente  from detalleEnvio d
inner join clientes c on c.codigoCliente = d.codigoCliente
inner join envio e on e.codigoEnvio = d.codigoEnvio
where e.codigoUsuario=idUsuario
group by c.nombreCliente;
end
$$



delimiter $$
create procedure clientesConMasEnvios()
begin
select count(c.codigoCliente) as Cliente, c.nombreCliente  from detalleEnvio d
inner join clientes c on c.codigoCliente = d.codigoCliente
group by c.nombreCliente;
end
$$


delimiter $$
create procedure usuariosEnvios()
begin
select count(c.codigoUsuario) as Usuario, c.nomUsuario  from envio e
inner join usuario c on c.codigoUsuario = e.codigoUsuario
 group by c.nomUsuario;
end
$$


-- ===========================================================================
-- DATOS
-- ===========================================================================

# Rol
insert into rol values (null, 'Administrador');
insert into rol values (null, 'Solicitante');

# Auth (Autorización del Usuario)
insert into authUsuario values (null, 'Autorizado');
insert into authUsuario values (null, 'Esperando Autorizacion');
insert into authUsuario values (null, 'Restringido');
	
# Tipo de Tramite
insert into tipoTramite values(null, 'Entrega');
insert into tipoTramite values(null, 'Cobro');
insert into tipoTramite values(null, 'Transferencia');
insert into tipoTramite values(null, 'DepÃ³sito');
insert into tipoTramite values(null, 'Retiro de Cheques');
insert into tipoTramite values(null, 'Retiro de Documentos');

#Area
-- insert into area values (null, 'Administraci&oacute;n');
insert into area values (null, 'ABAS');
insert into area values (null, 'Tax y Legal');
insert into area values (null, 'RRHH');
insert into area values (null, 'Finanzas');

# Usuario
insert into usuario values (null, 'Karla Guadalupe', 'Arevalo Vega', 'kgarevalo', 'kgarevalo@deloitte.com', sha1('Deloitte123!'), 1, 1, 1);
insert into usuario values (null, 'Jorge Luis', 'Sidgo Pimentel', 'jlsidgo', 'jorge.sidgo@gmail.com', sha1('Deloitte123!'), 1, 1, 1);
insert into usuario values (null, 'John', 'Doe', 'johndoe', 'johndoe@deloitte.com', sha1('123'), 1, 2, 4);

#Cliente
insert into clientes values(null,'Telefonica','San Salvador','2314-1231');
insert into clientes values(null,'YKK','Santa Ana','2451-2312');
insert into clientes values(null,'Don Pollo','Santa Tecla','2451-6969');

#Tipo de Documento
insert into tipoDocumento values(null, 'FE');
insert into tipoDocumento values(null, 'F');
insert into tipoDocumento values(null, 'CCF');
insert into tipoDocumento values(null, 'Q');
insert into tipoDocumento values(null, 'Propuestas');
insert into tipoDocumento values(null, 'Informes');
insert into tipoDocumento values(null, 'Otro');

#Status 
insert into status values (null, 'Pendiente');
insert into status values (null, 'Revisado');
insert into status values (null, 'Completo');
insert into status values (null, 'Regresado a Finanzas');
