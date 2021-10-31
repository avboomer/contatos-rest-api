CREATE DATABASE dbContatos;

USE dbContatos;

CREATE TABLE tbContatos(
nome VARCHAR(100),
email VARCHAR(100));

INSERT INTO tbContatos(nome,email)
	VALUES("Maria","maria@hotmail.com"),
	("Antonio","antonio@hotmail.com"),
	("Jose","jose@hotmail.com"),
	("Amarildo","amarildo@hotmail.com"),
	("Noemi","noemi@hotmail.com"),
	("Dalva","dalva@hotmail.com"),
	("Lorivaldo","lorivaldo@hotmail.com"),
	("Alice","alice@hotmail.com"),
	("Nicole","nicole@hotmail.com"),
	("Vicente","vicente@hotmail.com"),
	("Emanuel","emanuel@hotmail.com"),
	("Gabriela","gabriela@hotmail.com");

SELECT * FROM tbContatos;