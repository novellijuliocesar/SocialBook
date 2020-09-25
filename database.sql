-- Creación de la Base de Datos
CREATE DATABASE ProyectoFinalLaravel;
-- Uso de la Base de Datos
USE ProyectoFinalLaravel;

-- Creación de la tabla de Usuarios
CREATE TABLE users(
id                  INT(255) AUTO_INCREMENT NOT NULL,
role                VARCHAR(20),
name                VARCHAR(100),
surname             VARCHAR(200),
mobile              VARCHAR(20),
nickname            VARCHAR(100) UNIQUE NOT NULL,
email               VARCHAR(255) UNIQUE NOT NULL,
password            VARCHAR(255) NOT NULL,
profileimage        VARCHAR(255),
created_at          DATETIME,
updated_at          DATETIME,
remember_token      VARCHAR(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

-- Creación de la tabla de seguidores
CREATE TABLE followers(
user_id            	INT(255),
follower_id         INT(255),
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_followers PRIMARY KEY(user_id, follower_id),
CONSTRAINT fk_users_followers FOREIGN KEY(user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_followers_users FOREIGN KEY(follower_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)ENGINE=InnoDb;

-- Creación de la tabla de Direcciones
CREATE TABLE addresses(
id                  INT(255) AUTO_INCREMENT NOT NULL,
address             VARCHAR(255) NOT NULL,
city                VARCHAR(255) NOT NULL,
state               VARCHAR(255) NOT NULL,
postalcode          VARCHAR(20) NOT NULL,
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_addresses PRIMARY KEY(id)
)ENGINE=InnoDb;


-- Creación de la tabla de Direcciones por Usuarios
CREATE TABLE users_addresses(
user_id            INT(255),
address_id         INT(255),
CONSTRAINT pk_users_addresses PRIMARY KEY(user_id, address_id),
CONSTRAINT fk_users_addresses FOREIGN KEY(user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_addresses_users FOREIGN KEY(address_id) REFERENCES addresses(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)ENGINE=InnoDb;


-- Creación de la tabla de Categorías
CREATE TABLE categories(
id                  INT(255) AUTO_INCREMENT NOT NULL,
nombre              VARCHAR(100) UNIQUE NOT NULL,      
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_categories PRIMARY KEY(id)
)ENGINE=InnoDb;


-- Creación de la tabla de Tipos de Likes
CREATE TABLE typelikes(
id                  INT(255) AUTO_INCREMENT NOT NULL,
name                VARCHAR(50) UNIQUE NOT NULL,     
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_typelikes PRIMARY KEY(id)
)ENGINE=InnoDb;


-- Definición de dos tipos de Likes
INSERT INTO typelikes VALUES(NULL, 'Like', CURTIME(), CURTIME());


-- Creación de la tabla de Estados
CREATE TABLE states(
id                  INT(255) AUTO_INCREMENT NOT NULL,
name                VARCHAR(50) UNIQUE NOT NULL,     
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_states PRIMARY KEY(id)
)ENGINE=InnoDb;


-- Creación de la tabla de Entradas
CREATE TABLE posts(
id                  INT(255) AUTO_INCREMENT NOT NULL,
user_id             INT(255),
category_id         INT(255),
postshared_id       INT(255),
state_id            INT(255),
title               VARCHAR(255) NOT NULL,
postimage           VARCHAR(255) NOT NULL,
description         TEXT,
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_posts PRIMARY KEY(id),
CONSTRAINT fk_posts_users FOREIGN KEY(user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_posts_categories FOREIGN KEY(category_id) REFERENCES categories(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_posts_states FOREIGN KEY(state_id) REFERENCES states(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_posts_posts FOREIGN KEY(postshared_id) REFERENCES posts(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)ENGINE=InnoDb;


-- Creación de la tabla de Comentarios
CREATE TABLE comments(
id                  INT(255) AUTO_INCREMENT NOT NULL,
user_id             INT(255),
post_id             INT(255),
commentshared_id    INT(255),
content             TEXT NOT NULL,
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_comments_posts FOREIGN KEY(post_id) REFERENCES posts(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_comments_comments FOREIGN KEY(commentshared_id) REFERENCES comments(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)ENGINE=InnoDb;


-- Creación de la tabla de Likes
CREATE TABLE likes(
id                  INT(255) AUTO_INCREMENT NOT NULL,
user_id             INT(255),
post_id             INT(255),
comment_id          INT(255),
typelike_id         INT(255),
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_likes_posts FOREIGN KEY(post_id) REFERENCES posts(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_likes_comments FOREIGN KEY(comment_id) REFERENCES comments(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_likes_typelikes FOREIGN KEY(typelike_id) REFERENCES typelikes(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)ENGINE=InnoDb;


-- Creación de la tabla de Pedidos
CREATE TABLE orders(
id                  INT(255) AUTO_INCREMENT NOT NULL,
user_id             INT(255),
post_id             INT(255),
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_ordes PRIMARY KEY(id),
CONSTRAINT fk_orders_users FOREIGN KEY(user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_orders_posts FOREIGN KEY(post_id) REFERENCES posts(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)ENGINE=InnoDb;