ALTER TABLE store
DROP CONSTRAINT fk_manager;

ALTER TABLE store
DROP CONSTRAINT fk_category;

ALTER TABLE image
DROP CONSTRAINT fk_product;

ALTER TABLE commentary
DROP CONSTRAINT fk_store;

ALTER TABLE commentary
DROP CONSTRAINT fk_commenter;

DROP TABLE commentary;
DROP TABLE store;
DROP TABLE users;
DROP TABLE category;
DROP TABLE image;
DROP SEQUENCE image_sequence;
DROP SEQUENCE store_sequence;

CREATE TABLE users(
id_user DECIMAL(21) NOT NULL PRIMARY KEY,
name_user VARCHAR2(60) NOT NULL,
email_user VARCHAR2(60) NOT NULL,
google_link VARCHAR2(60) NOT NULL,
google_picture_link VARCHAR2(200) NOT NULL);

CREATE TABLE category(
id_category INTEGER NOT NULL PRIMARY KEY,
cat_description VARCHAR2(30));

CREATE TABLE image(
id_image INTEGER NOT NULL PRIMARY KEY,
id_product INTEGER NOT NULL,
image_name VARCHAR2(30));

CREATE SEQUENCE image_sequence
START WITH 1
INCREMENT BY 1
NOMAXVALUE;

CREATE TABLE store(
id_store INTEGER NOT NULL PRIMARY KEY,
id_manager DECIMAL(21) NOT NULL,
name_store VARCHAR2(15),
price_per_product FLOAT,
creation_date DATE,
product_category INTEGER,
description_store VARCHAR2(100));

ALTER TABLE store
ADD CONSTRAINT fk_manager
FOREIGN KEY (id_manager)
REFERENCES users(id_user);

ALTER TABLE store
ADD CONSTRAINT fk_category
FOREIGN KEY (product_category)
REFERENCES category(id_category);

CREATE SEQUENCE store_sequence
START WITH 1
INCREMENT BY 1
NOMAXVALUE;

ALTER TABLE image
ADD CONSTRAINT fk_product
FOREIGN KEY (id_product)
REFERENCES store(id_store);

CREATE SEQUENCE comment_sequence
START WITH 1
INCREMENT BY 1
NOMAXVALUE;

CREATE TABLE commentary(
id_comment INTEGER NOT NULL PRIMARY KEY,
id_store INTEGER NOT NULL,
id_commenter DECIMAL(21) NOT NULL,
content_comment VARCHAR2(300),
date_comment DATE);

ALTER TABLE commentary
ADD CONSTRAINT fk_store
FOREIGN KEY (id_store)
REFERENCES store(id_store);

ALTER TABLE commentary
ADD CONSTRAINT fk_commenter
FOREIGN KEY (id_commenter)
REFERENCES users(id_user);
