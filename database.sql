-- Créer la base de données
CREATE DATABASE IF NOT EXISTS panier_bijoux;
USE panier_bijoux;

-- Table des catégories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

-- Table des produits
CREATE TABLE IF NOT EXISTS produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(200) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    categorie_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categorie_id) REFERENCES categories(id)
);

-- Insérer des catégories
INSERT INTO categories (nom) VALUES 
('Colliers'),
('Bracelets'),
('Bagues'),
('Boucles d\'oreilles'),
('Pendentifs');

-- Insérer des produits exemples
INSERT INTO produits (nom, description, prix, image, categorie_id) VALUES
('Collier en Or Rose', 'Superbe collier en or rose avec pendentif en forme de cœur', 150.00, 'collier1.jpg', 5),
('Bracelet Diamant', 'Bracelet élégant avec petits diamants', 220.00, 'bracelet1.jpg', 2),
('Bague Saphir', 'Bague en argent avec saphir bleu', 180.00, 'bague1.jpg', 3),
('Boucles d\'oreilles Perles', 'Boucles d\'oreilles en perles naturelles', 95.00, 'boucle1.jpg', 4),
('Collier Argent', 'Collier en argent sterling avec pendentif étoile', 120.00, 'collier2.jpg', 1),
('Bracelet Cuir', 'Bracelet en cuir avec fermoir argenté', 65.00, 'bracelet2.jpg', 2);