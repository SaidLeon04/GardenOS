CREATE TABLE usuarios (
  id_usuario int(10) AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) UNIQUE,
  correo varchar(100) UNIQUE,
  passwd varchar(128) NOT NULL,
  dias date NOT NULL,
  imagen varchar(255)
);

CREATE TABLE plantas (
  id_planta int(10) AUTO_INCREMENT PRIMARY KEY,
  id_usuario int(10) NOT NULL,
  nombre varchar(255) NOT NULL,
  tipo set('hortaliza','ornato') NOT NULL,
  descripcion varchar(510) NOT NULL,
  imagen varchar(255) DEFAULT NULL,
  foreign key (id_usuario) references usuarios(id_usuario) on delete cascade on update cascade
);

CREATE TABLE lote (
  id_lote int(10) AUTO_INCREMENT PRIMARY KEY,
  id_planta int(10) NOT NULL,
  id_sensor int(10),
  nombre_lote varchar(255) NOT NULL,
  fecha_inicial varchar(20) NOT NULL,
  cantidad_inicial int(20) NOT NULL,
  cantidad_actual int(10) NOT NULL,
  estado set('germinacion','siembra','crecimiento','cosecha','finalizado') NOT NULL,
  humedad_optima int(20) NOT NULL,
  temperatura_optima int(20) NOT NULL,
  foreign key (id_planta) references plantas(id_planta) on delete cascade on update cascade
);

CREATE TABLE sensores(
  id_sensor int(10) AUTO_INCREMENT PRIMARY KEY,
  id_lote int(10),
  nombre varchar(128) NOT NULL,
  valor float(20) NOT NULL,
  foreign key (id_lote) references lote(id_lote) on delete cascade on update cascade
);

CREATE TABLE lotes_terminados (
  id_lote_terminado int(10) AUTO_INCREMENT PRIMARY KEY,
  id_lote int(10),
  fecha_final date NOT NULL,
  cantidad_final int(10) NOT NULL,
  dias int(10) NOT NULL,
  eficacia FLOAT NOT NULL,
  foreign key (id_lote) references lote(id_lote) on delete cascade on update cascade
);

CREATE TABLE historial (
  id_historial int(10) AUTO_INCREMENT PRIMARY KEY,
  id_lote int(10),
  estado varchar(50) DEFAULT NULL,
  fecha date DEFAULT NULL,
  cantidad int(20) NOT NULL,
  foreign key (id_lote) references lote(id_lote) on delete cascade on update cascade
); 

CREATE TABLE humedad (
  id_humedad int(10) AUTO_INCREMENT PRIMARY KEY,
  id_lote int(10),
  fecha varchar(12) DEFAULT NULL,
  hora varchar(12) DEFAULT NULL,
  humedad float DEFAULT NULL,
  foreign key (id_lote) references lote(id_lote) on delete cascade on update cascade
); 

CREATE TABLE riego (
  id_riego int(10) AUTO_INCREMENT PRIMARY KEY,
  id_lote int(10),
  fecha date DEFAULT NULL,
  hora time DEFAULT NULL,
  duracion varchar(12) DEFAULT NULL,
  foreign key (id_lote) references lote(id_lote) on delete cascade on update cascade
);

CREATE TABLE temperatura (
  id_temperatura int(10) AUTO_INCREMENT PRIMARY KEY,
  id_lote int(10),
  fecha varchar(12) DEFAULT NULL,
  hora varchar(12) DEFAULT NULL,
  temperatura float DEFAULT NULL,
  foreign key (id_lote) references lote(id_lote) on delete cascade on update cascade
); 


/* TEST TABLES 


CREATE TABLE iluminacion (
  id_iluminacion int(11) NOT NULL,
  id_lote int(11) DEFAULT NULL,
  fecha varchar(12) DEFAULT NULL,
  hora varchar(12) DEFAULT NULL,
  situacion varchar(30) DEFAULT NULL,
  iluminacion float DEFAULT NULL
) 


CREATE TABLE crecimiento (
  id_crecimiento int(11) NOT NULL,
  id_lote int(11) DEFAULT NULL,
  fecha varchar(12) DEFAULT NULL,
  medida float DEFAULT NULL
);

*/
