DROP TABLE IF EXISTS beerUsesIngredient;
DROP TABLE IF EXISTS fermentation;
DROP TABLE IF EXISTS fermentationType;
DROP TABLE IF EXISTS kegOrder;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS brew;
DROP TABLE IF EXISTS beer;
DROP TABLE IF EXISTS beerType;
DROP TABLE IF EXISTS ingredient;
DROP TABLE IF EXISTS unit;
DROP TABLE IF EXISTS user;
DROP VIEW IF EXISTS userSafe;


/*
 * User
 */
CREATE TABLE user (
    id smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(15) NOT NULL UNIQUE,
    password varchar(256) NOT NULL,
    isAdmin boolean NOT NULL DEFAULT false,
    created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    passwordExpDate date DEFAULT NULL
) ENGINE=INNODB;

/* Remove these for production application? These are here for our convenience right now. 
   Not sure how else to seed an admin account. */
INSERT INTO user VALUES
    (DEFAULT, 'admin', '$2y$10$N5FtjNxtYAxB0WuoXHU.eOVVGeL3.kqtuSFKKnOpbEZ6vdlph.4Py', true, DEFAULT, DEFAULT),
    (DEFAULT, 'test', '$2y$10$cDYAjrH6f/Q9SMjd5/EiNOxWzG1M/3BbNQO3NNU/0WBWzs8IxpAoe', false, DEFAULT, DEFAULT);

CREATE VIEW userSafe AS SELECT id, username, isAdmin, created, passwordExpDate FROM user;

/*
 * Unit
 */
CREATE TABLE unit (
    id smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(8) NOT NULL UNIQUE
) ENGINE=INNODB;

INSERT INTO unit VALUES
    (DEFAULT, 'bags'),
    (DEFAULT, 'oz'),
    (DEFAULT, 'lbs');


/*
 * FermentationType
 */
CREATE TABLE fermentationType (
    id smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(20) NOT NULL UNIQUE
) ENGINE=INNODB;


/*
 * Ingredient
 */
CREATE TABLE ingredient (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(30) NOT NULL,
    supplier varchar(30) DEFAULT NULL,
    quantity float NOT NULL DEFAULT 0,
    unitId smallint NOT NULL,
    FOREIGN KEY (unitId) REFERENCES unit (id)
) ENGINE=INNODB;


/*
 * BeerType
 */
CREATE TABLE beerType (
    id smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(20) NOT NULL UNIQUE
) ENGINE=INNODB;


/*
 * Beer
 */
CREATE TABLE beer (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(20) NOT NULL,
    createdBy smallint NOT NULL,
    FOREIGN KEY (createdBy) REFERENCES user (id)
) ENGINE=INNODB;


/*
 * BeerUsesIngedient
 */
CREATE TABLE beerUsesIngredient (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    beerId int NOT NULL,
    ingredientId int NOT NULL,
    quantity float NOT NULL,
    FOREIGN KEY (beerId) REFERENCES beer (id),
    FOREIGN KEY (ingredientId) REFERENCES ingredient (id)
) ENGINE=INNODB;


/**
 * Brew
 */
CREATE TABLE brew (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date datetime NOT NULL,
    quantity float NOT NULL,
    beerId int NOT NULL,
    userId smallint NOT NULL,
    FOREIGN KEY (beerId) REFERENCES beer (id),
    FOREIGN KEY (userId) REFERENCES user (id)
) ENGINE=INNODB;


/*
 * Fermentation
 */
CREATE TABLE fermentation (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    typeId smallint NOT NULL,
    unitId smallint NOT NULL,
    brewId int NOT NULL,
    userId smallint NOT NULL,
    FOREIGN KEY (typeId) REFERENCES fermentationType (id),
    FOREIGN KEY (unitId) REFERENCES unit (id),
    FOREIGN KEY (brewId) REFERENCES brew (id),
    FOREIGN KEY (userId) REFERENCES user (id)
) ENGINE=INNODB;

/**
 * Customer
 */
CREATE TABLE customer (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName varchar(20) NOT NULL,
    lastName varchar(20) NOT NULL,
    phoneNumber varchar(12),
    email varchar(50),
    address varchar(30) NOT NULL,
    city varchar(20) NOT NULL,
    state varchar(2) NOT NULL,
    zipCode varchar(5) NOT NULL
) ENGINE=INNODB;

/**
 * KegOrder
 */
CREATE TABLE kegOrder (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pickupDate datetime NOT NULL,
    returnDate datetime NOT NULL,
    customerId int NOT NULL,
    brewId int NOT NULL,
    userId smallint NOT NULL,
    FOREIGN KEY (customerId) REFERENCES customer (id),
    FOREIGN KEY (brewId) REFERENCES brew (id),
    FOREIGN KEY (userId) REFERENCES user (id)
) ENGINE=INNODB;