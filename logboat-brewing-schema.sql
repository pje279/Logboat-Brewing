DROP TABLE IF EXISTS user;

CREATE TABLE user (
	id smallint AUTO_INCREMENT PRIMARY KEY,
	username varchar(15) UNIQUE,
	password varchar(20)
);

INSERT INTO user VALUES (DEFAULT, 'test', 'pass');