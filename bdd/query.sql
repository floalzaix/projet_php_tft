CREATE DATABASE projet_php_tft;

USE projet_php_tft;

DROP TABLE IF EXISTS units;

CREATE TABLE units (
    id VARCHAR(50),
    name VARCHAR(50) NOT NULL,
    cost INT NOT NULL,
    origin VARCHAR(100) NOT NULL,
    url_img TEXT NOT NULL
) ENGINE="InnoDB" CHARSET utf8mb4;

INSERT INTO units(id, name, cost, origin, url_img) VALUE ("blabla", "car", 0, "miaou, mm, k, klf", "https://www.pixorwall.com/modules/image_gallery/images/2-galerie-desktop/Nature/Paysages/Montagnes/fond_d_ecran_paysage_de_montagne_wallpaper_005.jpg");
INSERT INTO units(id, name, cost, origin, url_img) VALUE ("blabla2", "car2", 0, "miaou2", "https://test.com2");

