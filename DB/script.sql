CREATE TABLE `cambio_tierra` (
  `id_tierra` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `textura` set('arenosa','arcillosa','limosa') DEFAULT NULL,
  `cantidad_tierra` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `crecimiento` (
  `id_crecimiento` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `medida` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `estado` varchar(12) DEFAULT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `humedad` (
  `id_humedad` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `hora` varchar(12) DEFAULT NULL,
  `humedad` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `iluminacion` (
  `id_iluminacion` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `hora` varchar(12) DEFAULT NULL,
  `situacion` varchar(30) DEFAULT NULL,
  `iluminacion` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `nombre_lote` varchar(50) NOT NULL,
  `id_planta` int(5) NOT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `estado` set('germinacion','siembra','crecimiento','cosecha','finalizado') DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_variable` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `lotes_terminados` (
  `id_lote_terminado` int(10) NOT NULL,
  `id_lote` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_planta` int(10) NOT NULL,
  `nombre_lote` varchar(100) NOT NULL,
  `fecha_inicial` date NOT NULL,
  `fecha_final` date NOT NULL,
  `cantidad_inicial` int(10) NOT NULL,
  `cantidad_final` int(10) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `eficacia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `plagas` (
  `id_plaga` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `nombre_plaga` varchar(30) DEFAULT NULL,
  `tratamiento` varchar(200) DEFAULT NULL,
  `afectaciones` varchar(255) DEFAULT NULL,
  `causas` varchar(255) DEFAULT NULL,
  `peligro` varchar(20) NOT NULL,
  `imagen_plaga` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `plantas` (
  `id_planta` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `tipo` set('hortaliza','ornato','matorral') DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `poda` (
  `id_poda` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `fecha` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `riego` (
  `id_riego` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `duracion` varchar(12) DEFAULT NULL,
  `cantidad_agua` float DEFAULT NULL,
  `unidad` varchar(30) NOT NULL,
  `ph_agua` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `temperatura` (
  `id_temperatura` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `hora` varchar(12) DEFAULT NULL,
  `temperatura` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `passwd` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `cambio_tierra`
  ADD PRIMARY KEY (`id_tierra`),
  ADD KEY `tierra_id_loto` (`id_lote`);

ALTER TABLE `crecimiento`
  ADD PRIMARY KEY (`id_crecimiento`),
  ADD KEY `id_lote` (`id_lote`);

ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_lote` (`id_lote`);

ALTER TABLE `humedad`
  ADD PRIMARY KEY (`id_humedad`),
  ADD KEY `humedad_id_lote` (`id_lote`);

ALTER TABLE `iluminacion`
  ADD PRIMARY KEY (`id_iluminacion`),
  ADD KEY `id_lote` (`id_lote`);

ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_planta` (`id_planta`);

ALTER TABLE `lotes_terminados`
  ADD PRIMARY KEY (`id_lote_terminado`);

ALTER TABLE `plagas`
  ADD PRIMARY KEY (`id_plaga`),
  ADD KEY `id_lote` (`id_lote`);

ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id_planta`),
  ADD KEY `id_usuario` (`id_usuario`);

ALTER TABLE `poda`
  ADD PRIMARY KEY (`id_poda`),
  ADD KEY `id_lote` (`id_lote`);

ALTER TABLE `riego`
  ADD PRIMARY KEY (`id_riego`),
  ADD KEY `id_lote` (`id_lote`);

ALTER TABLE `temperatura`
  ADD PRIMARY KEY (`id_temperatura`),
  ADD KEY `id_lote` (`id_lote`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);


ALTER TABLE `cambio_tierra`
  MODIFY `id_tierra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `crecimiento`
  MODIFY `id_crecimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

ALTER TABLE `humedad`
  MODIFY `id_humedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `iluminacion`
  MODIFY `id_iluminacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

ALTER TABLE `lotes_terminados`
  MODIFY `id_lote_terminado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `plagas`
  MODIFY `id_plaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `plantas`
  MODIFY `id_planta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

ALTER TABLE `poda`
  MODIFY `id_poda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `riego`
  MODIFY `id_riego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

ALTER TABLE `temperatura`
  MODIFY `id_temperatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `cambio_tierra`
  ADD CONSTRAINT `cambio_tierra_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

ALTER TABLE `crecimiento`
  ADD CONSTRAINT `crecimiento_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

ALTER TABLE `humedad`
  ADD CONSTRAINT `humedad_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

ALTER TABLE `iluminacion`
  ADD CONSTRAINT `iluminacion_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

ALTER TABLE `lote`
  ADD CONSTRAINT `id_planta` FOREIGN KEY (`id_planta`) REFERENCES `plantas` (`id_planta`);

ALTER TABLE `plagas`
  ADD CONSTRAINT `plagas_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

ALTER TABLE `plantas`
  ADD CONSTRAINT `plantas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

ALTER TABLE `poda`
  ADD CONSTRAINT `poda_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

ALTER TABLE `riego`
  ADD CONSTRAINT `riego_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

ALTER TABLE `temperatura`
  ADD CONSTRAINT `temperatura_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);
COMMIT;

