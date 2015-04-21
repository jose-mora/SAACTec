-- Proyecto SAACTec
-- Curso Taller Modelos de Desarrollo de Software
-- Script CREACION DEL MODELO
-- Versión 1.0
-- Fecha: 20-ABR-2015
-- Creado por: emora

-- ------------------------------------------------------
--  Crea base de datos TestDB
-- ------------------------------------------------------

CREATE DATABASE IF NOT EXISTS  TestDB;
USE TestDB;

-- -----------------------------------------------------
-- Tabla:  Sede
-- -----------------------------------------------------
CREATE TABLE  Sede (
  idSede INT NOT NULL AUTO_INCREMENT,
  nombreSede VARCHAR(100) NOT NULL,
  Activo TINYINT(1) NOT NULL,
  CreadoPor INT NOT NULL,
  ModificadoPor INT NULL,
  FechaCreacion DATETIME NOT NULL,
  FechaModificacion DATETIME  NULL,
  PRIMARY KEY (idSede))
ENGINE = InnoDB;