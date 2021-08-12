Please, to properly use this code you need to change pdo host and dbname
for your own configurantions. The same applies for user and password.

I have create a database named b7web with table users. To create those, please
use the follow sql commands.
########################### START SQL #########################
--Create the dabase
CREATE DATABASE b7web;

--Select the database;
USE b7web;

--Create table users with three columns
CREATE TABLE IF NOT EXISTS users ( 
	id INT AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(100) NOT NULL, 
	email VARCHAR(100)
) ENGINE=INNODB
  COLLATE utf8_general_ci;

########################### END SQL ##############################  
