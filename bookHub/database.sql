USE bookhub;

-- Creación de la tabla Libro
CREATE TABLE IF NOT EXISTS libro (
    ISBN VARCHAR(13) PRIMARY KEY,
    Titulo VARCHAR(255) NOT NULL,
    Autor VARCHAR(255) NOT NULL,
    Genero VARCHAR(100) NOT NULL,
    Precio DECIMAL(10, 2) NOT NULL,
    Stock INT NOT NULL
);

-- Creación de la tabla Usuario
CREATE TABLE IF NOT EXISTS usuario (
    ID_usuario INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL
);

-- Creación de la tabla Pedido
CREATE TABLE IF NOT EXISTS pedido (
    ID_pedido INT PRIMARY KEY AUTO_INCREMENT,
    ID_usuario INT NOT NULL,
    Nombre VARCHAR(25) NOT NULL,
    Correo VARCHAR(50) NOT NULL,
    Direccion VARCHAR(50) NOT NULL,
    Ciudad VARCHAR(255) NOT NULL,
    Codigo_postal VARCHAR(20) NOT NULL,
    Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (ID_usuario) REFERENCES usuario(ID_usuario)
);

-- Creación de la tabla Resena
CREATE TABLE IF NOT EXISTS resena (
    ID_resena INT PRIMARY KEY AUTO_INCREMENT,
    ID_libro VARCHAR(13) NOT NULL,
    ID_usuario INT NOT NULL,
    Calificacion INT NOT NULL,
    Contenido TEXT,
    Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ID_libro) REFERENCES libro(ISBN),
    FOREIGN KEY (ID_usuario) REFERENCES usuario(ID_usuario)
);

-- Creación de la tabla Detalle_Pedido
CREATE TABLE IF NOT EXISTS detalle_pedido (
    ID_detalle INT PRIMARY KEY AUTO_INCREMENT,
    ID_pedido INT NOT NULL,
    ISBN VARCHAR(13) NOT NULL,
    Titulo VARCHAR(255) NOT NULL,
    Autor VARCHAR(255) NOT NULL,
    Precio DECIMAL(10, 2) NOT NULL,
    Cantidad INT NOT NULL,
    FOREIGN KEY (ID_pedido) REFERENCES pedido(ID_pedido),
    FOREIGN KEY (ISBN) REFERENCES libro(ISBN)
);

-- Índices adicionales para mejorar la eficiencia en las consultas JOIN
CREATE INDEX idx_pedido_id_usuario ON pedido(ID_usuario);
CREATE INDEX idx_resena_id_libro ON resena(ID_libro);
CREATE INDEX idx_resena_id_usuario ON resena(ID_usuario);
CREATE INDEX idx_detalle_pedido_id_pedido ON detalle_pedido(ID_pedido);
CREATE INDEX idx_detalle_pedido_isbn ON detalle_pedido(ISBN);

INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Genero`, `Precio`, `Stock`) VALUES ('9780063058501', 'Heartless Hunter', 'Kristen Ciccarelli', 'ficcion', '18.90', '5');

INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Genero`, `Precio`, `Stock`) VALUES ('9780593239473', 'The demon of unrest', 'Erik Larson', 'No ficcion', '20.65', '10');

INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Genero`, `Precio`, `Stock`) VALUES ('9780593336829', 'Bride', 'Ali Hazelwood', 'Romantica, Fantasia', '14.00', '5');

INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Genero`, `Precio`, `Stock`) VALUES ('9781635574091', 'House of flame and shadow', 'Sarah J. Maas', 'fantasia', '21.37', '6');

 INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Genero`, `Precio`, `Stock`) VALUES ('9781982181183', 'Miss Morgans Book Brigade', 'Janet Skeslien Charles', 'novela historica', '22.70', '6')