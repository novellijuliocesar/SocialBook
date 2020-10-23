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

-- Creación de la tabla de Entradas
CREATE TABLE posts(
id                  INT(255) AUTO_INCREMENT NOT NULL,
user_id             INT(255),
title               VARCHAR(255) NOT NULL,
postimage           VARCHAR(255) NOT NULL,
author              VARCHAR(255) NOT NULL,
editorial			VARCHAR(255) NOT NULL,
pages				INT NOT NULL,
description         TEXT,
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_posts PRIMARY KEY(id),
CONSTRAINT fk_posts_users FOREIGN KEY(user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)ENGINE=InnoDb;


-- Creación de la tabla de Comentarios
CREATE TABLE comments(
id                  INT(255) AUTO_INCREMENT NOT NULL,
user_id             INT(255),
post_id             INT(255),
content             TEXT NOT NULL,
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_comments_posts FOREIGN KEY(post_id) REFERENCES posts(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)ENGINE=InnoDb;


-- Creación de la tabla de Likes
CREATE TABLE likes(
id                  INT(255) AUTO_INCREMENT NOT NULL,
user_id             INT(255),
post_id             INT(255),
created_at          DATETIME,
updated_at          DATETIME,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_likes_posts FOREIGN KEY(post_id) REFERENCES posts(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)ENGINE=InnoDb;