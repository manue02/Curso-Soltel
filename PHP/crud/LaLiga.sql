/* Script para crear BBDD LaLiga */

/* 1. Borrar BBDD si existe*/
DROP DATABASE IF EXISTS LaLiga;

/* 2. Crear BBDD */
CREATE DATABASE IF NOT EXISTS LaLiga
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish_ci;

USE LaLiga;

/* 3. Crear tabla Clubes (Principal) */
CREATE TABLE IF NOT EXISTS Clubes
(
	cif CHAR(9) UNIQUE NOT NULL,
    nombre VARCHAR(45) UNIQUE NOT NULL,
    fundacion YEAR NOT NULL,
    num_socios MEDIUMINT,
    estadio VARCHAR(45) NOT NULL,
    activo BOOLEAN DEFAULT 1,
    PRIMARY KEY PK_Clubes (cif),
    INDEX IDX_Clubes_nombre (nombre)
) ENGINE InnoDB
COMMENT "Tabla Principal Clubes";

/* 4. Crear tabla Posiciones (Principal) */
CREATE TABLE IF NOT EXISTS Posiciones
(
	idPosicion TINYINT NOT NULL AUTO_INCREMENT,
    posicion VARCHAR(45) NOT NULL,
    PRIMARY KEY PK_Posiciones (idPosicion)
)ENGINE InnoDB
COMMENT "Tabla Principal Posiciones";

/* 5. Crear tabla Jugadores (Secundaria) */
/* NO pongo ON UPDATE CASCADE en Posiciones porque las IDs
   AUTONUMERICAS no se suelen modificar */
CREATE TABLE IF NOT EXISTS Jugadores
(
	nif_nie CHAR(9) UNIQUE NOT NULL,
    nombre VARCHAR(45) UNIQUE NOT NULL,
    edad TINYINT NOT NULL,
    cedido BOOLEAN NULL DEFAULT 0,
    ficha DECIMAL(8,2),
    idPosicion TINYINT NOT NULL,
    cif CHAR(9) NOT NULL,
    PRIMARY KEY PK_Jugadores (nif_nie),
    INDEX IDX_Jugadores_nombre (nombre),
    FOREIGN KEY FK_Jugadores_idPosicion (idPosicion)
		REFERENCES Posiciones (idPosicion),
	FOREIGN KEY FK_Jugadores_cif (cif)
		REFERENCES Clubes (cif)
        ON UPDATE CASCADE 
)ENGINE InnoDB
COMMENT "Tabla Secundaria Jugadores";


/* 6. Crear tabla Entrenadores (Secundaria)*/
CREATE TABLE IF NOT EXISTS Entrenadores
(
	nif_nie CHAR(9) UNIQUE NOT NULL,
    nombre VARCHAR(45) UNIQUE NOT NULL,
    edad TINYINT NOT NULL,
    destituido BOOLEAN NULL DEFAULT 0,
    ficha DECIMAL(8,2),
    cif CHAR(9) NOT NULL,
    PRIMARY KEY PK_Entrenadores (nif_nie),
    INDEX IDX_Entrenadores_nombre (nombre),
	FOREIGN KEY FK_Entrenadores_cif (cif)
		REFERENCES Clubes (cif)
        ON UPDATE CASCADE 
) ENGINE InnoDB
COMMENT "Tabla Secundaria Entrenadores";

/* 7. Crear tabla Partidos (Secundaria) */
CREATE TABLE IF NOT EXISTS Partidos
(
	Clubes_cif_local CHAR(9) NOT NULL,
    Clubes_cif_visitante CHAR(9) NOT NULL,
    fecha DATE NOT NULL,
    goles_local TINYINT NOT NULL,
    goles_visitante TINYINT NOT NULL,
    arbitro VARCHAR(45) NOT NULL,
    PRIMARY KEY PK_Partidos (Clubes_cif_local, Clubes_cif_visitante),
    FOREIGN KEY FK_Partidos_cif_local (Clubes_cif_local)
		REFERENCES Clubes (cif)
        ON UPDATE CASCADE,
    FOREIGN KEY FK_Partidos_cif_visitante (Clubes_cif_visitante)
		REFERENCES Clubes (cif)
        ON UPDATE CASCADE   
) ENGINE InnoDB
COMMENT "Tabla Secundaria Partidos";

# DATOS!!
USE LaLiga;

INSERT INTO Clubes
(cif, nombre, fundacion, num_socios, estadio)
VALUES
("11111111A", "Real Betis", 1907, 71000, "Benito Villamarin"),
("22222222A", "Sevilla FC", 1904, 46000, "Sanchez Pizjuan");

INSERT INTO Posiciones (posicion)
VALUES 
("Portero"), 
("Defensa"), 
("Medio"), 
("Extremo"), 
("Delantero");

INSERT INTO Entrenadores
VALUES
("88888888A", "Manuel Pellegrini", 70, 0, 600000, "11111111A"),
("99999999B", "Quique Sanchez Flores", 58, 0, 400000, "22222222A");

INSERT INTO Jugadores
VALUES
("66666666C", "Francisco Alarcón", 31, 0, 200000, 5, "11111111A"),
("77777777D", "Jesus Navas", 38, 0, 200000, 2, "22222222A");

INSERT INTO Partidos
VALUES
("22222222A", "11111111A", "2023-11-12", 1, 1, "Jesús Gil Manzano");


SELECT
    ClubesLocal.nombre AS ClubLocal,
    EntrenadoresLocal.nombre AS EntrenadorLocal,
    Partidos.goles_local AS Local,
    Partidos.goles_visitante AS Visitante,
    ClubesVisitante.nombre AS ClubVisitante,
    EntrenadoresVisitante.nombre AS EntrenadorVisitante,
    Partidos.fecha AS FechaPartido,
    Partidos.arbitro AS Arbitro
FROM Partidos
JOIN Clubes AS ClubesLocal ON Partidos.Clubes_cif_local = ClubesLocal.cif
JOIN Entrenadores AS EntrenadoresLocal ON ClubesLocal.cif = EntrenadoresLocal.cif
JOIN Clubes AS ClubesVisitante ON Partidos.Clubes_cif_visitante = ClubesVisitante.cif
JOIN Entrenadores AS EntrenadoresVisitante ON ClubesVisitante.cif = EntrenadoresVisitante.cif
WHERE Clubes_cif_local = "22222222A";










