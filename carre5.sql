-- Cré BDD
DROP DATABASE IF EXISTS carrefive;
CREATE DATABASE carrefive CHARACTER SET utf8;
USE carrefive;

-- Cré Table user (utilisateurs)
CREATE TABLE carrefive.user (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR (25) NOT NULL,
    password VARCHAR (512) NOT NULL
);

-- Cré Table produc (produits)
CREATE TABLE carrefive.product (
    product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (255) NOT NULL,
    description TEXT NOT NULL,
    price FLOAT NOT NULL,
    image VARCHAR (512),
    dlc DATE
);

-- Modifier une table
ALTER TABLE carrefive.user ADD UNIQUE(`username`);

INSERT INTO carrefive.product (name,description,price,dlc) VALUES
('PANZANI Coquillettes', 'Des coquillettes panzani !', 0.76, '2025-11-09'),
('MAGNUM Classic x4', 'Boite de 4 magnums classic', 2.34, '2022-05-09'),
('CARRE5 500 Feuilles A4', 'Rame de papier A4 90gr', 4.01, null),
('PAIC Citron', 'Du liquide vaisselle', 1.76, null);

-- Cré Table category
CREATE TABLE category (
    category_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR (100) NOT NULL
) ENGINE = INNODB;

-- Insert données category
INSERT INTO category (label) VALUES
    ('Animaux'),
    ('Boissons'),
    ('Boucherie'),
    ('Charcuterie'),
    ('Électroménager'),
    ('Entretien & Nettoyage'),
    ('Épicerie salée'),
    ('Épicerie sucrée'),
    ('Fruits & Légumes'),
    ('Hygiène & Beauté'),
    ('Jardin & Bricolage'),
    ('Produits laitiers');