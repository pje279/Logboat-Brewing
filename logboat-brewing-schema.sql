DROP TABLE IF EXISTS user;

CREATE TABLE user (
    id smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(15) NOT NULL UNIQUE,
    password varchar(60) NOT NULL
);

DROP TABLE IF EXISTS ingredient;

CREATE TABLE ingredient (
    id smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(30) NOT NULL,
    supplier varchar(30) DEFAULT NULL,
    quantity float NOT NULL DEFAULT 0,
    units ENUM('oz', 'mL', 'L', 'lbs')
);

INSERT INTO ingredient VALUES
    (DEFAULT, 'Salt', 'SaltCo', DEFAULT, 'oz'),
    (DEFAULT, 'Pepper', 'Pepper Inc.', 15.63, 'oz');