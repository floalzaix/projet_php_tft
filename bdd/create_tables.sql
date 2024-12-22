CREATE DATABASE projet_php_tft;

USE projet_php_tft;

DROP TABLE IF EXISTS units_origins;
DROP TABLE IF EXISTS units;
DROP TABLE IF EXISTS origins;

CREATE TABLE units (
    id VARCHAR(50),
    name VARCHAR(50) NOT NULL,
    cost INT NOT NULL,
    url_img TEXT NOT NULL,
    PRIMARY KEY (id)
) ENGINE="InnoDB" CHARSET utf8mb4;

CREATE TABLE origins (
    id VARCHAR(50),
    name VARCHAR(50) NOT NULL,
    url_img TEXT NOT NULL,
    PRIMARY KEY (id)
) ENGINE="InnoDB" CHARSET utf8mb4;

CREATE TABLE units_origins (
    id_unit VARCHAR(50),
    id_origin VARCHAR(50),
    FOREIGN KEY (id_unit) REFERENCES units(id) ON DELETE CASCADE,
    FOREIGN KEY (id_origin) REFERENCES origins(id) ON DELETE CASCADE
) ENGINE="InnoDB" CHARSET utf8mb4;

SELECT * FROM origins;
