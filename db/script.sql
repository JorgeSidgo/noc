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
    fecha date
);

create table detalleEnvio (
	codigoDetalleEnvio int primary key unique auto_increment,
    codigoTipoTramite int,
    codigoCliente int,
    codigoEnvio int,
    codigoTipoDocumento int,
    codigoArea int,
    codigoTramite int,
    observacion text,
    codigoStatus int
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

create table tramite (
    codigoTramite int primary key unique auto_increment
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
alter table detalleEnvio add constraint fk_detalleEnvio_tramite foreign key (codigoTramite) references tramite(codigoTramite);
alter table detalleEnvio add constraint fk_detalleEnvio_clientes foreign key (codigoCliente) references clientes(codigoCliente);
-- alter table detalleEnvio add constraint fk_detalleEnvio_observaciones foreign key (codigoObservaciones) references observaciones(codigoObservaciones);
alter table detalleEnvio add constraint fk_detalleEnvio_status foreign key (codigoStatus) references status(codigoStatus);

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
insert into tipoTramite values(null, 'Dep&oacute;sito');
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
insert into usuario values (null, 'John', 'Doe', 'johndoe', 'johndoe@deloitte.com', sha1('123'), 2, 2, 4);

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
insert into status values (null, 'Enviado');
insert into status values (null, 'Regresado a Finanzas');

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
