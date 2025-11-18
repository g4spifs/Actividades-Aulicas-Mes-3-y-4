CREATE DATABASE Halloween

CREATE TABLE disfraces (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  descripcion text NOT NULL,
  votos int(11) NOT NULL DEFAULT 0,
  foto varchar(255) NOT NULL,  
  eliminado int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
);


CREATE TABLE usuarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  clave varchar(255) NOT NULL, 
  PRIMARY KEY (id),
  UNIQUE KEY (nombre) 
);


CREATE TABLE votos (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_usuario int(11) NOT NULL,
  id_disfraz int(11) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (usuario_disfraz_unico) 
);
);

