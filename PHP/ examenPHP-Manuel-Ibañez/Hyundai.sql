-- Si existe la tabla la borramos
DROP DATABASE IF EXISTS Hyundai;
CREATE DATABASE IF NOT EXISTS Hyundai
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish_ci;

USE Hyundai;

CREATE TABLE IF NOT EXISTS Coche (
    `matricula` VARCHAR(15) UNIQUE NOT NULL,
    `modelo` VARCHAR(255) NOT NULL,
    `ano_fabricacion` SMALLINT NOT NULL,
    `tipo_combustible` VARCHAR(255) NOT NULL,
    `precio` DECIMAL(8, 2) NOT NULL,
    `color` VARCHAR(255) NOT NULL,
    PRIMARY KEY PK_matricula (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS Cliente (
    `nif` varchar(9) UNIQUE NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `direccion` VARCHAR(255) NOT NULL,
    `telefono` VARCHAR(9) NOT NULL UNIQUE,
    `Activo` BOOLEAN,
    `fecha_alta` DATE NOT NULL,
    PRIMARY KEY PK_nif (`nif`),
    INDEX IDX_Cliente_Nombre (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Empleado (
    `nif` varchar(9) UNIQUE NOT NULL,
    `nombre` VARCHAR(255) NOT NULL,
    `fecha_contratacion` DATE NOT NULL,
    `salario` DECIMAL(10, 2) NOT NULL,
    `telefono` VARCHAR(9) NOT NULL UNIQUE,
    `Activo` BOOLEAN NOT NULL, 
    PRIMARY KEY PK_nif (`nif`),
    INDEX IDX_Empleado_Nombre (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Factura (
    `numero_factura` INT AUTO_INCREMENT NOT NULL, 
    `nif_vendedor` VARCHAR(9) NOT NULL,
    `fecha` DATE NOT NULL,
    `nif_cliente` VARCHAR(9) NOT NULL,
    `matricula_coche_comprado`VARCHAR(15) NOT NULL,
    `total` DECIMAL(10, 2),
    `Activo` BOOLEAN NOT NULL, 
    PRIMARY KEY PK_numero_factura (`numero_factura`),
    FOREIGN KEY (nif_cliente) REFERENCES Cliente(nif) ON UPDATE CASCADE,
    FOREIGN KEY (matricula_coche_comprado) REFERENCES Coche(matricula) ON UPDATE CASCADE,
    FOREIGN KEY (nif_vendedor) REFERENCES Empleado(nif) ON UPDATE CASCADE,
    INDEX IDX_Factura_Fecha (fecha)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO Coche (matricula, modelo, ano_fabricacion, tipo_combustible, precio, color)
VALUES ('ABC1234', 'Modelo1', 2020, 'Gasolina', 20000.00, 'Rojo');

INSERT INTO Cliente (nif, nombre, direccion, telefono, Activo, fecha_alta)
VALUES ('12345678A', 'Juan', 'Calle Ejemplo, 1', 123456789, 1, '2022-01-01');

INSERT INTO Cliente (nif, nombre, direccion, telefono, Activo, fecha_alta)
VALUES ('12345678H', 'Juan Pedro', 'Calle Ejemplo, 2', 122222222, 1, '2022-01-01');

INSERT INTO Empleado (nif, nombre, fecha_contratacion, salario, telefono, Activo)
VALUES ('98765432B', 'Ana', '2022-01-01', 1500.00, 111111111, 1);

INSERT INTO Empleado (nif, nombre, fecha_contratacion, salario, telefono, Activo)
VALUES ('98765432H', 'Maria', '2022-01-01', 1500.00, 222222222, 1);
