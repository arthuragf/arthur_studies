Please, to properly use this code you need to change pdo host and dbname
for your own configurantions. The same applies for user and password.

I have create a database named b7web with table users. To create those, please
use the follow sql commands.

CREATE DATABASE b7web;

USE b7web;

CREATE TABLE IF NOT EXISTS users ( 
	id INT AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(100) NOT NULL, 
	email VARCHAR(100)
) ENGINE=INNODB
  COLLATE utf8_general_ci;
