DROP DATABASE IF EXISTS centro_salud;
CREATE DATABASE centro_salud;
USE centro_salud;
CREATE TABLE especialidades (
  id_especialidad int auto_increment primary key,
  nombre varchar(100) not null unique,
  descripcion text
);
CREATE TABLE medicos (
  id_medico int auto_increment primary key,
  nombre varchar(150) not null,
  email varchar(100) unique,
  telefono varchar(20),
  licencia_profesional varchar(50) not null unique,
  id_especialidad int not null,
  estado varchar(20) default 'activo',
  fecha_contratacion datetime default current_timestamp,
  foreign key (id_especialidad) references especialidades(id_especialidad)
);