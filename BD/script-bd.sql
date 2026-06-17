
	CREATE DATABASE livro_db;
    
    USE livro_db;
    
    CREATE TABLE Usuarios(
		id_usuario INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(100) NOT NULL,
        sobrenome VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL
    );
    
-- Atividade prática 1

	CREATE TABLE Livros (
		id_livro INT PRIMARY KEY AUTO_INCREMENT,
        titulo VARCHAR(100) NOT NULL,
        descricao VARCHAR(500) NOT NULL,
        autor VARCHAR(100) NOT NULL
    );
    
    CREATE TABLE Estoque (
		id_estoque INT PRIMARY KEY AUTO_INCREMENT,
		id_livro INT,
        id_usuario INT,
        CONSTRAINT fk_estoque_livro
			FOREIGN KEY (id_livro) REFERENCES Livros(id_livro)
            ON DELETE CASCADE,
        quantidade_atual INT
	);
    
    CREATE TABLE Log_movimentacao_estoque (
		id_usuario INT,
        id_livro INT,
        data_movimentacao DATE NOT NULL,
        quantidade INT,
        tipo VARCHAR(100) NOT NULL,
        CONSTRAINT fk_id_livro 
			FOREIGN KEY (id_livro) REFERENCES Livros(id_livro)
            ON DELETE CASCADE,
		CONSTRAINT fk_log_usuario
			FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
            ON DELETE RESTRICT
    );
    
-- Atividade prática 2

	INSERT INTO Usuarios (nome, sobrenome, email, senha) VALUES
	('Ana','Lemes','ana@email.com','123'),
	('Alexandre','Alves','alexandre@email.com','123'),
	('Carlos','Zordão','carlos@email.com','123'),
	('Daniela','Souza','daniela@email.com','123'),
	('Eduardo','Teixeira','eduardo@email.com','123'),
	('Fernanda','Pereira','fernanda@email.com','123'),
	('Gabriel','Debs','gabriel@email.com','123'),
	('Helena','Petrenis','helena@email.com','123'),
	('Igor','Martins','igor@email.com','123'),
	('Juliana','Carvalho','juliana@email.com','123'),
	('Kleber','Gomes','kleber@email.com','123'),
	('Larissa','Viziolli','larissa@email.com','123'),
	('Marcos','Fernandes','marcos@email.com','123'),
	('Cauã','Munhoz','caua@email.com','123'),
	('Otávio','Caliman','otavio@email.com','123');
    
    INSERT INTO Livros (titulo, descricao, autor) VALUES
	('Dom Casmurro','Romance realista brasileiro','Machado de Assis'),
	('O Guarani','Romance indianista','José de Alencar'),
	('Iracema','Romance indianista','José de Alencar'),
	('Memórias Póstumas','Romance realista','Machado de Assis'),
	('A Moreninha','Romance romântico','Joaquim Manuel'),
	('Capitães da Areia','Romance social','Jorge Amado'),
	('Vidas Secas','Romance regionalista','Graciliano Ramos'),
	('O Cortiço','Romance naturalista','Aluísio Azevedo'),
	('1984','Distopia','George Orwell'),
	('A Revolução dos Bichos','Fábula política','George Orwell'),
	('O Hobbit','Fantasia','J.R.R. Tolkien'),
	('Harry Potter','Fantasia','J.K. Rowling'),
	('Percy Jackson','Fantasia','Rick Riordan'),
	('O Pequeno Príncipe','Fábula','Antoine de Saint-Exupéry'),
	('Senhora','Romance','José de Alencar');
    
    INSERT INTO Estoque (id_livro, id_usuario, quantidade_atual) VALUES
	(1,1,10),
	(2,2,5),
	(3,3,8),
	(4,4,12),
	(5,5,7),
	(6,6,15),
	(7,7,9),
	(8,8,6),
	(9,9,11),
	(10,10,4);
    
    INSERT INTO Log_movimentacao_estoque (id_usuario, id_livro, data_movimentacao, quantidade, tipo) VALUES
	(1,1,'2026-02-01',5,'ENTRADA'),
	(2,2,'2026-02-02',2,'SAIDA'),
	(3,3,'2026-02-03',3,'ENTRADA'),
	(4,4,'2026-02-04',1,'SAIDA'),
	(5,5,'2026-02-05',4,'ENTRADA'),
	(6,6,'2026-02-06',2,'SAIDA'),
	(7,7,'2026-02-07',3,'ENTRADA'),
	(8,8,'2026-02-08',1,'SAIDA'),
	(9,9,'2026-02-09',6,'ENTRADA'),
	(10,10,'2026-02-10',2,'SAIDA');
    
-- Atividade prática 3

	SELECT nome, sobrenome FROM Usuarios;
    
	    SELECT 
	    Livros.titulo, Estoque.quantidade_atual 
			FROM Livros 
	        INNER JOIN Estoque ON Livros.id_livro = Estoque.id_livro;
        
	SELECT 
    Usuarios.nome, Livros.titulo, Log_movimentacao_estoque.quantidade, log_movimentacao_estoque.tipo
		FROM log_movimentacao_estoque
		INNER JOIN Usuarios ON Log_movimentacao_estoque.id_usuario = Usuarios.id_usuario
		INNER JOIN Livros ON Log_movimentacao_estoque.id_livro = Livros.id_livro;
        
	SELECT
    Livros.titulo,
    Estoque.quantidade_atual
		FROM Livros 
		INNER JOIN Estoque  ON Livros.id_livro = Estoque.id_livro WHERE Estoque.quantidade_atual < 5;
        
-- Atividade prática 4

	UPDATE Usuarios 
		SET sobrenome = 'Lemes Caliman'
        WHERE id_usuario = 1;
        
	UPDATE Estoque 
		SET quantidade_atual = quantidade_atual + 10
        WHERE id_livro = 5;
        
	UPDATE Usuarios 
		SET senha = '123456_temp'
        WHERE email = 'ana@email.com';
        
	UPDATE Estoque
		SET quantidade_atual = quantidade_atual + 1
		WHERE quantidade_atual = 0;