SET SQL_SAFE_UPDATES = 0;
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
ALTER TABLE pacientes DROP COLUMN razon_consulta;

CREATE TABLE citas (
  id_cita int auto_increment primary key,
  id_paciente int not null,
  id_medico int not null,
  fecha_hora datetime not null,
  motivo varchar(255),
  estado varchar(20) default 'pendiente',
  fecha_creacion datetime default current_timestamp,
  foreign key (id_paciente) references pacientes(id_paciente) on delete cascade,
  foreign key (id_medico) references medicos(id_medico) on delete restrict
);

CREATE TABLE consultas (
  id_consulta int auto_increment primary key,
  id_paciente int not null,
  id_medico int not null,
  fecha_hora datetime default current_timestamp,
  sintomas text,
  diagnostico text,
  notas_medico text,
  estado varchar(20) default 'completada',
  fecha_creacion datetime default current_timestamp,
  foreign key (id_paciente) references pacientes(id_paciente) on delete cascade,
  foreign key (id_medico) references medicos(id_medico) on delete restrict
);

CREATE TABLE medicamentos (
  id_medicamento int auto_increment primary key,
  nombre varchar(150) not null,
  principio_activo varchar(150),
  precio decimal(10,2),
  stock int default 0,
  fecha_vencimiento date,
  descripcion text,
  fecha_actualizacion datetime default current_timestamp on update current_timestamp
);

CREATE TABLE recetas (
  id_receta int auto_increment primary key,
  id_consulta int not null,
  id_medicamento int not null,
  dosis varchar(100),
  duracion varchar(50),
  indicaciones text,
  fecha_creacion datetime default current_timestamp,
  foreign key (id_consulta) references consultas(id_consulta) on delete cascade,
  foreign key (id_medicamento) references medicamentos(id_medicamento) on delete restrict
);

CREATE TABLE facturacion (
  id_factura int auto_increment primary key,
  id_consulta int not null,
  id_paciente int not null,
  monto decimal(10,2) not null,
  metodo_pago varchar(50),
  estado varchar(20) default 'pendiente',
  fecha_factura datetime default current_timestamp,
  fecha_pago datetime,
  foreign key (id_consulta) references consultas(id_consulta) on delete cascade,
  foreign key (id_paciente) references pacientes(id_paciente) on delete cascade
);


-- ESPECIALIDADES 
DELETE FROM especialidades;
INSERT INTO especialidades (nombre, descripcion) VALUES
('Cardiología', 'Especialidad del corazón y sistema cardiovascular'),
('Pediatría', 'Medicina para niños y adolescentes'),
('Dermatología', 'Especialidad de la piel'),
('Neurología', 'Especialidad del sistema nervioso'),
('Oftalmología', 'Especialidad de los ojos');

-- MEDICOS 
DELETE FROM medicos;
INSERT INTO medicos (nombre, email, telefono, licencia_profesional, id_especialidad) VALUES
('Dr. Juan García', 'juan.garcia@salud.com', '931647426', 'LIC001', 1),
('Dra. María López', 'maria.lopez@salud.com', '956231456', 'LIC002', 2),
('Dr. Carlos Rodríguez', 'carlos.rodriguez@salud.com', '912345678', 'LIC003', 3),
('Dra. Ana Martínez', 'ana.martinez@salud.com', '923456789', 'LIC004', 4),
('Dr. Pedro Sánchez', 'pedro.sanchez@salud.com', '934567890', 'LIC005', 5);

-- PACIENTES 
DELETE FROM pacientes;
INSERT INTO pacientes (nombre, dni, email, telefono, fecha_nacimiento, direccion, tipo_sangre, alergias) VALUES
('Pacifico Huamán', '71648131', 'pacifico@paciente1', '931647426', '2003-04-15', 'Jirón Arábigo, Huánuco', 'A+', 'Penicilina'),
('Juan Pérez', '71648123', 'juan@paciente2', '956231456', '2002-08-20', 'Av. Principal, Huánuco', 'B+', 'Ninguna'),
('Carlos Mendoza', '71648124', 'carlos@paciente3', '912345678', '2000-12-10', 'Calle 2, Huánuco', 'O+', 'Ibuprofeno'),
('Rosa García', '71648125', 'rosa@paciente4', '923456789', '1998-06-05', 'Av. Secundaria, Huánuco', 'AB-', 'Ninguna'),
('Miguel Torres', '71648126', 'miguel@paciente5', '934567890', '2001-03-25', 'Jirón Central, Huánuco', 'O-', 'Gluten');

-- CITAS 
DELETE FROM citas;
INSERT INTO citas (id_paciente, id_medico, fecha_hora, motivo, estado) VALUES
(1, 1, '2025-08-21 10:00:00', 'Revisión cardiaca anual', 'confirmada'),
(2, 2, '2025-08-21 14:30:00', 'Control de desarrollo infantil', 'pendiente'),
(3, 3, '2025-08-22 09:00:00', 'Consulta por erupción cutánea', 'confirmada'),
(4, 4, '2025-08-22 15:00:00', 'Evaluación neurológica', 'pendiente'),
(5, 5, '2025-08-23 11:00:00', 'Examen oftalmológico', 'confirmada');

-- CONSULTAS 
DELETE FROM consultas;
INSERT INTO consultas (id_paciente, id_medico, sintomas, diagnostico, notas_medico, estado) VALUES
(1, 1, 'Palpitaciones ocasionales', 'Arritmia cardíaca leve', 'Monitorear frecuencia cardíaca', 'completada'),
(2, 2, 'Crecimiento normal', 'Desarrollo infantil adecuado', 'Continuar evaluaciones periódicas', 'completada'),
(3, 3, 'Manchas rojas en brazos', 'Dermatitis alérgica', 'Evitar alérgenos identificados', 'completada'),
(4, 4, 'Dolores de cabeza frecuentes', 'Migrañas crónicas', 'Prescribir tratamiento preventivo', 'completada'),
(5, 5, 'Visión borrosa lejana', 'Miopía moderada', 'Usar lentes correctivos', 'completada');

-- MEDICAMENTOS 
DELETE FROM medicamentos;
INSERT INTO medicamentos (nombre, principio_activo, precio, stock, fecha_vencimiento, descripcion) VALUES
('Ibuprofeno 400mg', 'Ibuprofeno', 18.50, 100, '2026-12-31', 'Analgésico y antiinflamatorio'),
('Amoxicilina 500mg', 'Amoxicilina', 25.00, 50, '2026-11-30', 'Antibiótico de amplio espectro'),
('Paracetamol 500mg', 'Paracetamol', 12.00, 150, '2027-01-31', 'Analgésico y antipirético'),
('Loratadina 10mg', 'Loratadina', 22.50, 75, '2026-10-31', 'Antihistamínico para alergias'),
('Omeprazol 20mg', 'Omeprazol', 28.00, 60, '2026-09-30', 'Inhibidor de bomba de protones');

-- RECETAS 
DELETE FROM recetas;
INSERT INTO recetas (id_consulta, id_medicamento, dosis, duracion, indicaciones) VALUES
(1, 1, '1 tableta cada 8 horas', '7 días', 'Tomar con alimentos'),
(2, 4, '1 tableta diaria', '14 días', 'No requiere alimentos'),
(3, 2, '1 cápsula cada 6 horas', '10 días', 'Completar el tratamiento'),
(4, 1, '2 tabletas cada 12 horas', '30 días', 'Para migrañas agudas'),
(5, 5, '1 tableta diaria en ayunas', '30 días', 'Tomar 30 minutos antes de comer');

-- FACTURACION 
DELETE FROM facturacion;
INSERT INTO facturacion (id_consulta, id_paciente, monto, metodo_pago, estado, fecha_pago) VALUES
(1, 1, 450.00, 'efectivo', 'pagada', '2025-08-21 10:30:00'),
(2, 2, 380.00, 'tarjeta', 'pagada', '2025-08-21 14:45:00'),
(3, 3, 420.00, 'transferencia', 'pendiente', NULL),
(4, 4, 440.00, 'efectivo', 'pagada', '2025-08-22 15:15:00'),
(5, 5, 400.00, 'tarjeta', 'pagada', '2025-08-23 11:20:00');