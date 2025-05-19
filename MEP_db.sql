CREATE database MEP_db;
USE MEP_db;

-- About Table
CREATE TABLE about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lang VARCHAR(2),
    content TEXT
);

INSERT INTO about (lang, content) VALUES
('en', 'We are a professional MEP team working on international projects.'),
('fr', 'Nous sommes une équipe MEP professionnelle travaillant sur des projets internationaux.');

-- Services Table
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lang VARCHAR(2),
    title VARCHAR(255),
    description TEXT
);

INSERT INTO services (lang, title, description) VALUES
('en', 'Electrical Installation', 'We provide high-quality electrical system setups.'),
('fr', 'Installation Électrique', 'Nous fournissons des installations électriques de haute qualité.');

-- Projects Table
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lang VARCHAR(2),
    title VARCHAR(255),
    description TEXT
);

INSERT INTO projects (lang, title, description) VALUES
('en', 'Residential Tower', 'Completed electrical and plumbing work.'),
('fr', 'Tour Résidentielle', 'Travaux électriques et de plomberie terminés.');

-- Contact Messages Table
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    message TEXT,
    lang VARCHAR(2),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
