USE bookhub;

-- Creación de la tabla Libro
CREATE TABLE IF NOT EXISTS libro (
    ISBN VARCHAR(13) PRIMARY KEY,
    Titulo VARCHAR(255) NOT NULL,
    Autor VARCHAR(255) NOT NULL,
    Estrellas Float NOT NULL,
    Precio DECIMAL(10, 2) NOT NULL,
    Image VARCHAR(255) NOT NULL,
    Description TEXT NOT NULL,
    Editorial VARCHAR(255) NOT NULL,
    Idioma VARCHAR(50) NOT NULL,
    Encuadernado VARCHAR(50) NOT NULL,
    Fecha_lanzamiento DATE NOT NULL,
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
-- Creación de la tabla Carrito
CREATE TABLE IF NOT EXISTS carrito (
    ID_carrito INT PRIMARY KEY AUTO_INCREMENT,
    ID_usuario INT NOT NULL,
    Fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ID_usuario) REFERENCES usuario(ID_usuario)
);

-- Creación de la tabla Detalle_Carrito
CREATE TABLE IF NOT EXISTS detalle_carrito (
    ID_detalle INT PRIMARY KEY AUTO_INCREMENT,
    ID_carrito INT NOT NULL,
    ISBN VARCHAR(13) NOT NULL,
    Titulo VARCHAR(255) NOT NULL,
    Autor VARCHAR(255) NOT NULL,
    Precio DECIMAL(10, 2) NOT NULL,
    Cantidad INT NOT NULL,
    Fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ID_carrito) REFERENCES carrito(ID_carrito),
    FOREIGN KEY (ISBN) REFERENCES libro(ISBN)
);
-- Índices adicionales para mejorar la eficiencia en las consultas JOIN
CREATE INDEX idx_pedido_id_usuario ON pedido(ID_usuario);
CREATE INDEX idx_resena_id_libro ON resena(ID_libro);
CREATE INDEX idx_resena_id_usuario ON resena(ID_usuario);
CREATE INDEX idx_detalle_pedido_id_pedido ON detalle_pedido(ID_pedido);
CREATE INDEX idx_detalle_pedido_isbn ON detalle_pedido(ISBN);
CREATE INDEX idx_carrito_id_usuario ON carrito(ID_usuario);
CREATE INDEX idx_detalle_carrito_id_carrito ON detalle_carrito(ID_carrito);
CREATE INDEX idx_detalle_carrito_isbn ON detalle_carrito(ISBN);


INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Estrellas` ,`Precio`,`Image`, `Description`, `Editorial`, `Idioma`, `Encuadernado`, `Fecha_lanzamiento`, `Stock`)
VALUES('9780063058501', 'Heartless Hunter', 'Kristen Ciccarelli', 4.5 ,18.90, 'img/heartless-hunter-kristen-ciccarelli.jpg', 'In a land ruled by ancient gods and 
treacherous politics, Asha is a fierce hunter dedicated to protecting her people from the monstrous
beasts that lurk in the dark. When a new threat arises, Asha must join forces
with a mysterious stranger who challenges everything she believes. Together,
they embark on a perilous journey to uncover secrets that could change their world forever.', 'HarperTeen', 'English', 'Hardcover', '2023-06-15', '6');

INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Estrellas`, `Precio`, `Image`, `Description`, `Editorial`, `Idioma`, `Encuadernado`, `Fecha_lanzamiento`, `Stock`)
VALUES ('9781635574091', 'HOUSE OF FLAME AND SHADOW', 'Sarah J. Maas', 4.8, 21.37, 'img/house-of-flame-and-shadow-sarah-j-maas.jpg',
'IThe latest installment in the Crescent City series, \"House of Flame and Shadow\" follows Bryce Quinlan as she navigates a world of magic, danger, and intrigue.
As ancient powers awaken and new threats emerge, Bryce and her allies must confront their deepest fears and uncover long-buried secrets to
protect their city and those they love.', 'Bloomsbury Publishing', 'English', 'Hardcover', '2023-11-14', '6');
 
INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Estrellas`, `Precio`, `Image`, `Description`, `Editorial`, `Idioma`, `Encuadernado`, `Fecha_lanzamiento`, `Stock`)
VALUES ('9781982181183', 'Miss Morgans Book Brigade', 'Janet Skeslien Charles', 4.5, 22.70, 'img/miss-morgans-book-brigade-janet-skeslien-charles.jpg',
'Set against the backdrop of World War II, \"Miss Morgans Book Brigade\" tells the story of an unlikely group of women who come together to form a mobile library,
bringing books and hope to those in need. As they navigate the challenges of war and personal loss, these women find strength, friendship, and a sense of 
purpose in the power of literature.', 'Atria Books', 'English', 'Paperback', '2023-09-10', '6');
INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Estrellas`, `Precio`, `Image`, `Description`, `Editorial`, `Idioma`, `Encuadernado`, `Fecha_lanzamiento`, `Stock`)
VALUES ('9780593239473', 'THE DEMON OF UNREST', 'Erik Larson', '4.6', '20.65',
'img/the-demon-of-unrest-erik-larson.jpg', 'Erik Larsons \"The Demon of Unrest\" delves into the dark sides of human nature and the chaos that can arise when societal
order breaks down. Through meticulously researched historical events and compelling narratives,
Larson explores how fear, paranoia, and violence can spread like wildfire, transforming ordinary people into agents of chaos.', 
'Crown Publishing Group', 'English', 'Hardcover', '2023-05-05', '6');

INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Estrellas`, `Precio`, `Image`, `Description`, `Editorial`, `Idioma`, `Encuadernado`, `Fecha_lanzamiento`, `Stock`)
VALUES ('9780593336829', 'Bride', 'Ali Hazelwood', 4.4, 14.00, 'img/bride-ali-hazelwood.jpg',
'In \"Bride\", Ali Hazelwood crafts a witty and heartwarming romance filled with unexpected twists and delightful characters. 
When a fiercely independent scientist agrees to an arranged marriage to secure funding for her research, she never expects to find herself falling
for her charming but enigmatic fiancé. As they navigate the complexities of love and ambition, they discover that true partnership means embracing 
each others strengths and vulnerabilities.', 'Berkley', 'English', 'Paperback', '2023-02-08', '7');


-- Inser para probar:
/*INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Estrellas`, `Precio`, `Image`, `Description`, `Editorial`, `Idioma`, `Encuadernado`, `Fecha_lanzamiento`, `Stock`)
VALUES ('9780593698440', 'Check & Mate1', 'Ali Hazelwood', '4.3', '8.59', 'img/check&mate.jfif', 'Check & Mate (2023) is a contemporary young adult
romance by Ali Hazelwood. The novel tells the story of Mallory Greenleaf, who at eighteen has sworn off chess, the sport she and her father loved. She supports her
family now that her father has died, and her mother struggles with basic tasks many days due to her chronic illness. Mallory’s inadvertent defeat of
Nolan Sawyer, the reigning World Champion of professional chess, leads her back into the world of chess, where she must face the pain of her past and learn how
to trust others.', 'G.P. Putnams Sons Books for Young Readers', 'English', 'Paperback', '2023-11-07', '1')*/