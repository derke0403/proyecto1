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
  fecha_contratacion datetime default current_timestamp,
  foreign key (id_especialidad) references especialidades(id_especialidad)
);
CREATE TABLE pacientes (
  id_paciente int auto_increment primary key,
  nombre varchar(150) not null,
  dni varchar(20) not null unique,
  email varchar(100) unique,
  telefono varchar(20),
  fecha_nacimiento date,
  direccion varchar(255),
  tipo_sangre varchar(5),
  alergias text,
  fecha_registro datetime default current_timestamp
);
ALTER TABLE pacientes ADD COLUMN razon_consulta varchar(255) AFTER alergias;