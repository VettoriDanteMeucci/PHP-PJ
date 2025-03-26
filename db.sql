CREATE DATABASE wiki;
USE wiki;

CREATE TABLE image (
    id INT PRIMARY KEY,
    exte VARCHAR(255),
    body BLOB
);
