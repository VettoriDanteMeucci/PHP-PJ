-- Creazione della tabella 'user'
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id dell'utente, PRIMARY KEY
    username VARCHAR(255) NOT NULL,     -- nome utente
    pass VARCHAR(255) NOT NULL          -- password
);

-- Creazione della tabella 'page' con la FK che fa riferimento a se stessa
CREATE TABLE page (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id della pagina, PRIMARY KEY
    name VARCHAR(255) NOT NULL,         -- nome della pagina
    creator INT,                        -- id dell'utente creatore (FK)
    parent_id INT,                      -- id della pagina parent (FK che fa riferimento alla stessa tabella 'page')
    FOREIGN KEY (creator) REFERENCES user(id),  -- FK che fa riferimento alla tabella 'user'
    FOREIGN KEY (parent_id) REFERENCES page(id) -- FK che fa riferimento alla tabella 'page' per la pagina parent
);

-- Creazione della tabella 'image'
CREATE TABLE image (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id dell'immagine, PRIMARY KEY
    exte VARCHAR(50),                   -- estensione dell'immagine (varchar)
    page INT,                           -- id della pagina a cui appartiene l'immagine (FK)
    body BLOB,                          -- corpo dell'immagine (campo BLOB)
    FOREIGN KEY (page) REFERENCES page(id)  -- FK che fa riferimento alla tabella 'page'
);

-- Creazione della tabella 'text'
CREATE TABLE text (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- id del testo, PRIMARY KEY
    page INT,                           -- id della pagina a cui appartiene il testo (FK)
    FOREIGN KEY (page) REFERENCES page(id)  -- FK che fa riferimento alla tabella 'page'
);
