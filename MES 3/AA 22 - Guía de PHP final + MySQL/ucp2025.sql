/* 1. Creamos la tabla 'menu' */
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `modulo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_menu`)
);

/* 2. Insertamos todos los ejercicios que hicimos */
INSERT INTO `menu` (`nombre`, `modulo`) VALUES
('Inicio', 'inicio'),
('Consigna 4 (Random)', 'ejercicio4'),
('Consigna 7 (If)', 'ejercicio7'),
('Consigna 8 (Bucles)', 'ejercicio8'),
('Consigna 9 (Form Edad)', 'ejercicio9'),
('Consigna 10 (Radio)', 'ejercicio10'),
('Consigna 11 (Checkbox)', 'ejercicio11'),
('Consigna 12 (Select)', 'ejercicio12'),
('Consigna 13 (Textarea)', 'ejercicio13'),
('Consigna 14 (Vectores)', 'ejercicio14'),
('Consigna 15 (Pizzeria)', 'ejercicio15'),
('Consigna 16 (Leer Pedidos)', 'ejercicio16'),
('Consigna 17 (Vect. Asoc.)', 'ejercicio17'),
('Consigna 18 (Funciones)', 'ejercicio18');

/* 3. Creamos la tabla 'pedidos' para la pizzeria (Consigna 15) */
CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `pedido_texto` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pedido`)
);