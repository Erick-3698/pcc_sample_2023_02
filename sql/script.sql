-- SCRIPT DE DDL - DATA DEFINITION LANGUAGE
-- apaga o banco de dados escolabd, se ele existir.
DROP SCHEMA IF EXISTS pccsampledb;

-- cria um banco de dados chamado escolabd.
CREATE SCHEMA pccsampledb;

-- cria uma tabela chamada perfil com os campos: 
-- id, nome.
CREATE TABLE pccsampledb.perfis (
    id              INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome            VARCHAR(60) NOT NULL,
    sigla           CHAR(3) NOT NULL
);

-- cria uma tabela chamada usuarios com os campos: 
-- id, email, password, nome, status, perfil e data_cadastro.
CREATE TABLE pccsampledb.usuarios (
    id              INTEGER PRIMARY KEY AUTO_INCREMENT,
    email           VARCHAR(255) NOT NULL UNIQUE,
    password        VARCHAR(60) NOT NULL,
    nome            VARCHAR(40) NOT NULL,
    status          BOOLEAN NOT NULL DEFAULT TRUE,  
    data_cadastro   DATETIME NOT NULL DEFAULT NOW(),
    perfil_id       INTEGER,
    CONSTRAINT fk_perfil FOREIGN KEY (perfil_id) 
                         REFERENCES perfis(id)
);

-- cria uma tabela chamada categorias com os campos: 
-- id, nome e status.
CREATE TABLE pccsampledb.categorias (
    id              INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome            VARCHAR(40) NOT NULL,
    status          BOOLEAN NOT NULL DEFAULT TRUE 
);

-- cria uma tabela chamada artigos com os campos: 
-- id, titulo, texto, status, data_publicacao, categoria e usuario.
CREATE TABLE pccsampledb.artigos (
    id                  INTEGER PRIMARY KEY AUTO_INCREMENT,
    titulo              VARCHAR(100) NOT NULL,
    texto               TEXT,
    status              BOOLEAN NOT NULL DEFAULT FALSE,
    data_publicacao     DATETIME DEFAULT NOW(),
    imagem              VARCHAR(255) NULL,
    categoria_id        INTEGER NOT NULL,
    usuario_id          INTEGER NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES pccsampledb.categorias(id),
    FOREIGN KEY (usuario_id) REFERENCES pccsampledb.usuarios(id)
);

-- SCRIPT DE DML - DATA MANIPULATION LANGUAGE
-- inserir dados na tabela de perfil. 
INSERT INTO pccsampledb.perfis (id, nome, sigla) 
VALUES
(1, 'Administrador', 'ADM'),
(2, 'Gerente', 'GER'),
(3, 'Editor', 'EDI'),
(4, 'Usuário', 'USU');
-- SCRIPT DE DML - DATA MANIPULATION LANGUAGE
-- inserir dados na tabela de usuario. 
INSERT INTO pccsampledb.usuarios (id, email, password, nome, perfil_id, status) 
VALUES 
(101, 'admin@email.com', md5('123'), 'Admin', 1, 1), 
(102, 'gerente@email.com', md5('1234'), 'Gerente', 2, 0), 
(103, 'editor@email.com', md5('12345'), 'Editor', 3, 0), 
(104, 'usuario@email.com', md5('123456'), 'Usuário', 4, 1); 


-- inserir dados na tabela de usuario. 
INSERT INTO pccsampledb.categorias (id, nome, status)
VALUES 
(101, 'Banco de dados', true),
(102, 'Redes', true),
(103, 'Desenvolvimento', true),
(104, 'Jogos', true),
(105, 'HTML5 & CSS3', true);

-- inserir dados na tabela de artigos.
INSERT INTO pccsampledb.artigos (id, titulo, status, data_publicacao, categoria_id, usuario_id, imagem, texto) 
VALUES
(1001, 'O poder do PHP', 1, '2023-05-01 09:35:00', 103, 103, "654790730ce731.44717516.jpg", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search" ),
(1002, 'SQL sem mistério', 1, '2023-05-02 10:40:00', 101, 103, "6547a04272ad59.60803827.png", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search"),
(1003, 'Aprenda JavaScript', 1, '2023-05-22 11:00:00', 103, 103, "6547955857e2a8.86351753.png", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search"),
(1004, 'Você tem medo de redes', 1, '2023-05-22 09:00:00', 102, 104, "65479f71b4a263.66008042.jpg", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search"),
(1005, 'Tour por Minecraft', 1, '2023-05-23 10:00:00', 104, 104, "6547953c3b5291.95268812.jpg", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search"),
(1006, 'Jogue com PS5', 1, '2023-05-23 10:20:00', 104, 104, "6547952d98a662.82370444.jpg", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search"),
(1007, 'PacMan', 1, '2023-05-23 10:35:00', 104, 104, "6547951864f472.08256578.png", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search"),
(1008, 'XBox para PS', 1, '2023-05-23 17:22:00', 104, 104, "6547954a3d34c3.82404269.jpg", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search"),
(1009, 'Sites em HTML 5 e CSS 3', 1, '2023-05-23 18:00:00', 105, 103, "6546d9a0b1cff3.23519938.jpg", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search");
