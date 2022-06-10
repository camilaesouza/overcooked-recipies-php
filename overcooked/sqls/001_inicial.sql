CREATE DATABASE overcooked COLLATE 'utf8_unicode_ci'; 

CREATE TABLE usuarios ( 
	id INT NOT NULL AUTO_INCREMENT , 
	nome VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	senha CHAR(60) NOT NULL,
	PRIMARY KEY (id)
) 
ENGINE = InnoDB;

CREATE TABLE receitas ( 
	id INT NOT NULL AUTO_INCREMENT , 
	titulo VARCHAR(255) NOT NULL , 
	descricao VARCHAR(255) NOT NULL , 
	ingredientes TEXT NOT NULL, 
	data_criacao DATETIME NOT NULL , 
	usuario_id INT NOT NULL , 
	PRIMARY KEY (id), 
	FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
) 
ENGINE = InnoDB;

CREATE TABLE comentarios ( 
	id INT NOT NULL AUTO_INCREMENT ,
	comentario TEXT NOT NULL, 
	receita_id INT NOT NULL ,
	usuario_id INT NOT NULL ,
	data_criacao DATETIME NOT NULL ,
	PRIMARY KEY (id), 
	FOREIGN KEY (usuario_id) REFERENCES usuarios (id),
	FOREIGN KEY (receita_id) REFERENCES receitas (id)
) 
ENGINE = InnoDB;
