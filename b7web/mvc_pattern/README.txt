Please, to properly use this code you need to change pdo host and dbname
for your own configurantions. The same applies for user and password.

I have create a database named mvc_pattern with table ads. To create those, please
use the follow sql commands.
########################### START SQL #########################
--Create the dabase
CREATE DATABASE mvc_pattern;

--Select the database;
USE pattern;

--Create table ads with two columns
CREATE TABLE IF NOT EXISTS ads ( 
	id INT AUTO_INCREMENT PRIMARY KEY, 
	title VARCHAR(50) NOT NULL
) ENGINE=INNODB
  COLLATE utf8_general_ci;

########################### END SQL ##############################  
