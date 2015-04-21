-- Proyecto SAACTec
-- Curso Taller Modelos de Desarrollo de Software
-- Script DATOS DE PRUEBA
-- Versión 1.0
-- Fecha: 20-ABR-2015
-- Creado por: emora

USE TestDB;

-- -----------------------------------------------------
-- Tabla:  Sede
-- -----------------------------------------------------

INSERT INTO sede
(idsede,
nombresede, 
activo, 
creadopor, 
modificadopor, 
fechacreacion, 
fechamodificacion)
VALUES 
(1,'Cartago',1,1,1,'2015-04-20','2015-04-20'),
(2,'San José',1,1,1,'2015-04-20','2015-04-20')

ON DUPLICATE KEY UPDATE idsede=VALUES(idsede);