CREATE DATABASE IF NOT EXISTS laravel_master;
USE laravel_master;


CREATE TABLE IF NOT EXISTS users(
    id int(255) auto_increment not null,
    role varchar(20),
    name varchar(100),
    surname varchar(200),
    nick varchar(100),
    email varchar(255),
    password varchar(255),
    image varchar(255),
    created_at datetime,
    updated_at datetime,
    remember_token varchar(255),
    CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE=InnoDb;


CREATE TABLE IF NOT EXISTS images(
    id int(255) auto_increment not null,
    user_id int(255),
    image_path varchar(255),
    description text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_images PRIMARY KEY (id),
    CONSTRAINT fk_images_users FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDb;


CREATE TABLE IF NOT EXISTS comments(
    id int(255) auto_increment not null,
    user_id int(255),
    image_id int(255),
    content text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_comments PRIMARY KEY (id),
    CONSTRAINT fk_comments_user FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY (image_id) REFERENCES images(id)
)ENGINE=InnoDb;


CREATE TABLE IF NOT EXISTS likes(
    id int(255) auto_increment not null,
    user_id int(255),
    image_id int(255),
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_likes PRIMARY KEY (id),
    CONSTRAINT fk_likes_user FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY (image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'Agustin', 'Silbestro', 'agussilbestro', 'asilbestro7@gmail.com', 'pass' ,NULL, CURTIME(),CURTIME(),NULL);
INSERT INTO users VALUES(NULL, 'user', 'Matias', 'Silbestro', 'matsilbestro', 'matisilbestro@gmail.com', 'pass' ,NULL, CURTIME(),CURTIME(),NULL);
INSERT INTO users VALUES(NULL, 'user', 'Martin', 'Silbestro', 'marsilbestro', 'martin@gmail.com', 'pass' ,NULL, CURTIME(),CURTIME(),NULL);

INSERT INTO images VALUES (NULL,4,'test.jpg','imagen de prueba 1',CURTIME(),CURTIME());
INSERT INTO images VALUES (NULL,4,'playa.jpg','imagen de prueba 2',CURTIME(),CURTIME());
INSERT INTO images VALUES (NULL,4,'vacaciones.jpg','imagen de prueba 3',CURTIME(),CURTIME());
INSERT INTO images VALUES (NULL,4,'familia.jpg','imagen de prueba 4',CURTIME(),CURTIME());

INSERT INTO comments VALUES (NULL,4,16,'Buena foto de familia!!',CURTIME(),CURTIME());
INSERT INTO comments VALUES (NULL,4,17,'Buena foto de playa!!',CURTIME(),CURTIME());
INSERT INTO comments VALUES (NULL,4,18,'Qué lindo lugar!!',CURTIME(),CURTIME());

INSERT INTO likes VALUES(NULL,4,18,CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,5,17,CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,4,16,CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,6,16,CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,5,17,CURTIME(),CURTIME());


