DROP TABLE IF EXISTS user;

CREATE TABLE user (
    id smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(15) NOT NULL UNIQUE,
    password varchar(256) NOT NULL,
    isAdmin boolean NOT NULL DEFAULT false,
    created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    passwordExpDate date DEFAULT NULL
);

/* Remove these for production application? These are here for our convenience right now. */
INSERT INTO user VALUES
    (DEFAULT, 'admin', '$2y$10$p3q/PNqE8oiVT5BujBbqQ.25TkK9l7N9o3ptMDnikRurSEVniqlwq', true, DEFAULT, DEFAULT),
    (DEFAULT, 'test', '$2y$10$cDYAjrH6f/Q9SMjd5/EiNOxWzG1M/3BbNQO3NNU/0WBWzs8IxpAoe', false, DEFAULT, DEFAULT);

DROP VIEW IF EXISTS userSafe;

CREATE VIEW userSafe AS SELECT id, username, isAdmin, created, passwordExpDate FROM user;

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