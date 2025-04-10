CREATE DATABASE wiki;
USE wiki;

-- Creazione della tabella 'user'
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id dell'utente, PRIMARY KEY
    username VARCHAR(255) NOT NULL,     -- nome utente
    pass VARCHAR(255) NOT NULL          -- password
);

CREATE TABLE admin (
	id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES user(id) ON DELETE CASCADE
);

-- Creazione della tabella 'page' con la FK che fa riferimento a se stessa
CREATE TABLE page (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id della pagina, PRIMARY KEY
    name VARCHAR(255) NOT NULL,         -- nome della pagina
    creator INT                         -- id dell'utente creatore (FK)
);

-- Creazione della tabella 'image'
CREATE TABLE image (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id dell'immagine, PRIMARY KEY
    exte VARCHAR(50),                   -- estensione dell'immagine (varchar)
    page INT,                           -- id della pagina a cui appartiene l'immagine (FK)
    body BLOB,                          -- corpo dell'immagine (campo BLOB)
    FOREIGN KEY (page) REFERENCES page(id) ON DELETE CASCADE -- FK che fa riferimento alla tabella 'page'
);

-- Creazione della tabella 'text'
CREATE TABLE text (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id del testo, PRIMARY KEY
    title VARCHAR(255),					-- titolo del paragrafo
    body TEXT,                          -- contiene il testo effettivo
    page INT,                           -- id della pagina a cui appartiene il testo (FK)
    FOREIGN KEY (page) REFERENCES page(id) ON DELETE CASCADE -- FK che fa riferimento alla tabella 'page'
);
