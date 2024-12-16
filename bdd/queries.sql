CREATE DATABASE projet_php_tft;

USE projet_php_tft;

DROP TABLE IF EXISTS units;
DROP TABLE IF EXISTS origins;
DROP TABLE IF EXISTS units_origins;

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

INSERT INTO units(id, name, cost, url_img) VALUE ("blabla", "car", 1,  "https://www.pixorwall.com/modules/image_gallery/images/2-galerie-desktop/Nature/Paysages/Montagnes/fond_d_ecran_paysage_de_montagne_wallpaper_005.jpg");
INSERT INTO units(id, name, cost, url_img) VALUE ("blabla2", "car2", 5,  "https://test.com2");
INSERT INTO units(id, name, cost, url_img) VALUE ("blabla3", "car3", 2,  "https://test.com2");
INSERT INTO units(id, name, cost, url_img) VALUE ("blabla4", "car2", 3,  "https://test.com2");
INSERT INTO units(id, name, cost, url_img) VALUE ("blabla5", "car2", 4,  "https://test.com2");

SELECT *
FROM units;

SELECT *
FROM origins;

SELECT *
FROM units_origins;
