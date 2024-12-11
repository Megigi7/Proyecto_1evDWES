

CREATE TABLE tarea (
  id int(5) PRIMARY KEY AUTO_INCREMENT,
  cif_nif varchar(9),
  nombre_cliente varchar(100),
  tel_s_contacto varchar(50),
  descripcion varchar(500),
  correo varchar(50),
  direccion varchar(30),
  poblacion varchar(30),
  codigo_postal int(5),
  provincia varchar(30),
  estado char(1),
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  operario_encargado varchar(100),
  fecha_realizacion DATE,
  anotaciones_anteriores varchar(500),
  anotaciones_posteriores varchar(500),
  ficheros varchar(500)
);
