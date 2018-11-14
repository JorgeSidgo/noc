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
    codigoRol int
);

create table rol (
    codigoRol int primary key unique auto_increment,
    descRol varchar(25)
);

create table authUsuario(
	codigoAuth int primary key unique auto_increment,
    descAuth varchar(25)
);

-- ===========================================================================
-- RELACIONES
-- ===========================================================================

alter table usuario add constraint fk_usuario_rol foreign key (codigoRol) references rol(codigoRol);
alter table usuario add constraint fk_usuario_auth foreign key (codigoAuth) references authUsuario(codigoAuth);

-- ===========================================================================
-- DATOS
-- ===========================================================================

# Rol
insert into rol values (null, 'Administrador');
insert into rol values (null, 'Solicitante');

# Auth (Autorización del Usuario)
insert into authUsuario values (null, 'Esperando Autorizacion');
insert into authUsuario values (null, 'Autorizado');

# Usuario

insert into usuario values (null, 'Karla Guadalupe', 'Arevalo Vega', 'kgarevalo', 'kgarevalo@deloitte.com', 'Deloite123!', 2, 1);