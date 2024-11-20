CREATE DATABASE projet_php_tft;

USE projet_php_tft;

DROP TABLE IF EXISTS unit;

CREATE TABLE unit (
    id VARCHAR(50),
    name VARCHAR(50) NOT NULL,
    cost INT NOT NULL,
    origin VARCHAR(100) NOT NULL,
    url_img VARCHAR(2090) NOT NULL
) ENGINE="InnoDB" CHARSET utf8mb4;

