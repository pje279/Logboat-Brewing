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

INSERT INTO ingredient VALUES
    (DEFAULT, 'Lemondrop Hop Pellets', 'Northern Brewer', 55, 11),
    (DEFAULT, 'Rahr 2-row pale', 'Rahr', 50, 21),
    (DEFAULT, 'Briess Caramel 6OL', 'Briess', 10, 21),
    (DEFAULT, 'Briess Caramel 8OL', 'Briess', 8.6, 21),
    (DEFAULT, 'Fawecett Pale Chocolate', 'Fawcett Pale', 10.2, 21),
    (DEFAULT, 'English Black Malt', 'Logboat', 3.3, 21);


/*
 * BeerType
 */
CREATE TABLE beerType (
    id smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(20) NOT NULL UNIQUE
) ENGINE=INNODB;

INSERT INTO beerType VALUES
    (DEFAULT, 'All Grain'),
    (DEFAULT, 'Wheat'),
    (DEFAULT, 'IPA');

/*
 * Beer
 */
CREATE TABLE beer (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    createdBy smallint NOT NULL,
    beerTypeId smallint NOT NULL,
    FOREIGN KEY (createdBy) REFERENCES user (id),
    FOREIGN KEY (beerTypeId) REFERENCES beerType (id)
) ENGINE=INNODB;

INSERT INTO beer VALUES
    (DEFAULT, 'Caribou Slobber Brown Ale', 1, 1),
    (DEFAULT, 'Squirrel Nutkin Ale', 1, 21),
    (DEFAULT, 'Janet''s Brown Ale', 1, 21);


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

INSERT INTO beerUsesIngredient VALUES
    (DEFAULT, 1, 11, 9),
    (DEFAULT, 1, 21, .75),
    (DEFAULT, 1, 31, .5),
    (DEFAULT, 1, 41, .25),
    (DEFAULT, 1, 51, .125);

/**
 * Brew
 */
CREATE TABLE brew (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    brewStart datetime NOT NULL,
    brewEnd datetime NOT NULL,
    quantity float NOT NULL,
    beerId int NOT NULL,
    userId smallint NOT NULL,
    FOREIGN KEY (beerId) REFERENCES beer (id),
    FOREIGN KEY (userId) REFERENCES user (id)
) ENGINE=INNODB;

INSERT INTO brew VALUES
    (DEFAULT, '2015-12-02 10:00:00', '2015-12-18 10:00:00', 450, 1, 1),
    (DEFAULT, '2016-01-05 08:00:00', '2016-02-04 14:30:00', 565, 11, 1),
    (DEFAULT, '2015-12-09 09:00:00', '2015-12-15 11:00:00', 675, 11, 1),
    (DEFAULT, '2015-12-21 10:00:00', '2015-12-25 16:15:00', 888, 1, 1);


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