# To connect to db:
# mysql -h <amazon endpoint> -P 3306 -u dbf -p
# To run queries:
# mysql -h <amazon endpoint> -P 3306 -u dbf -p < dbsetup.sql

################# Initialize database
# Uncomment if database and user already exist and you want to delete them
# DROP DATABASE dbf;
# DROP USER 'dbf'@'localhost';

# Create new database and new user
CREATE DATABASE dbf;
ALTER DATABASE dbf CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE USER 'dbf'@'localhost' IDENTIFIED BY 'password';
GRANT ALL ON dbf.* TO 'dbf'@'localhost';
FLUSH PRIVILEGES;

################# Create Users table
CREATE TABLE dbf.users
(
username VARCHAR(64) NOT NULL,
salt VARCHAR(64) NOT NULL,
passwordhash varchar(64) NOT NULL,
PRIMARY KEY (username)
);

# Insert test user
INSERT INTO dbf.users (username, salt, passwordhash)
VALUES('email@blah.com', 'saltphrase', SHA2(CONCAT('password', 'saltphrase'), 0))