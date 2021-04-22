CREATE DATABASE `RCDATABASE`;

USE `RCDATABASE`;

CREATE TABLE admin (
   username VARCHAR(80) PRIMARY KEY,
   PASSWORD VARCHAR(40) NOT NULL,
   fullname VARCHAR(80),
   contact VARCHAR(80),
   email VARCHAR(80)
);

INSERT INTO admin(username, password) VALUES('nhi', '123456');


UPDATE admin SET password = SHA('123456') WHERE username = 'nhi';