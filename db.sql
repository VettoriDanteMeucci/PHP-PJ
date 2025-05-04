CREATE DATABASE wiki;
USE wiki;

-- Creazione della tabella 'user'
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id dell'utente, PRIMARY KEY
    username VARCHAR(255) NOT NULL,     -- nome utente
    pass VARCHAR(255) NOT NULL,         -- password
    views INT DEFAULT 0                 -- il numero di volte che pagine legate al user sono state visualizzate
);

CREATE TABLE admin (
	id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES user(id) ON DELETE CASCADE
);

-- Creazione della tabella 'page' con la FK che fa riferimento a se stessa
CREATE TABLE page (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id della pagina, PRIMARY KEY
    name VARCHAR(255) NOT NULL,         -- nome della pagina
    creator INT,                        -- id dell'utente creatore (FK)
    views INT DEFAULT 0,                -- views della pagina
	FOREIGN KEY (creator) REFERENCES user(id) ON DELETE SET NULL
);

-- Creazione della tabella 'image'
CREATE TABLE image (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id dell'immagine, PRIMARY KEY
    exte VARCHAR(50),                   -- estensione dell'immagine (varchar)
    page INT,                           -- id della pagina a cui appartiene l'immagine (FK)
    body BLOB,                          -- corpo dell'immagine (campo BLOB)
    FOREIGN KEY (page) REFERENCES page(id) ON DELETE CASCADE -- FK che fa riferim ento alla tabella 'page'
);

-- Creazione della tabella 'text'
CREATE TABLE text (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id del testo, PRIMARY KEY
    title VARCHAR(255),					-- titolo del paragrafo
    body TEXT,                          -- contiene il testo effettivo
    page INT,                           -- id della pagina a cui appartiene il testo (FK)
    FOREIGN KEY (page) REFERENCES page(id) ON DELETE CASCADE -- FK che fa riferimento alla tabella 'page'
);

-- Creazione della tabella dei commenti
CREATE TABLE comment (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id del comment, PRIMARY KEY
    page INT,                           -- id della pagina cui appartiene il commento (varchar)
    creator INT,                        -- id del creatore della pagina (varchar)
    body TEXT,                       -- il testo del commento
    FOREIGN KEY (creator) REFERENCES user(id) ON DELETE SET NULL, -- FK del creatore della pagina
    FOREIGN KEY (page) REFERENCES page(id) ON DELETE CASCADE      -- FK della pagina del commento
)
