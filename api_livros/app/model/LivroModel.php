<?php

    class LivroModel {
        private $db;
        
        public function __construct($db) {
            $this->db = $db;
        }

        public function buscarLivros() {
            $stmt = $this->db->query(
                "SELECT 
                    Livros.id_livro,
                    Livros.titulo,
                    Livros.descricao,
                    Livros.autor,
                    Estoque.quantidade_atual AS estoque
                FROM Livros
                LEFT JOIN Estoque ON Livros.id_livro = Estoque.id_livro;"
            );
          
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLivrosPeloTitulo($titulo) {
           $stmt = $this->db->prepare("   
                SELECT 
                    Livros.id_livro,
                    Livros.titulo,
                    Livros.descricao,
                    Livros.autor,
                    Estoque.quantidade_atual AS estoque
                FROM Livros
                LEFT JOIN Estoque ON Estoque.id_livro = Livros.id_livro
                WHERE Livros.titulo LIKE :titulo
            ");
            $stmt->bindValue(':titulo', '%' . $titulo . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLivroPeloId($id) {
            $stmt = $this->db->prepare("
                SELECT 
                    Livros.id_livro,
                    Livros.titulo,
                    Livros.descricao,
                    Livros.autor,
                    Estoque.id_estoque,
                    Estoque.quantidade_atual AS estoque
                FROM Livros
                LEFT JOIN Estoque ON Estoque.id_livro = Livros.id_livro
                WHERE Livros.id_livro = :id_livro
            ");
            $stmt->bindValue(':id_livro', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updateLivro($id, $titulo, $autor, $descricao) {
                $stmt = $this->db->prepare("
                UPDATE Livros 
                SET titulo = :titulo, 
                    autor = :autor, 
                    descricao = :descricao 
                WHERE id_livro = :id
            ");
            
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':autor', $autor);
            $stmt->bindValue(':descricao', $descricao);
            $stmt->bindValue(':titulo', $titulo);
            
            return $stmt->execute();
        }

        public function createLivro($titulo, $autor, $descricao) {
            $stmt = $this->db->prepare("
                INSERT INTO Livros (titulo, autor, descricao) 
                VALUES (:titulo, :autor, :descricao)
            ");

            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':autor', $autor);
            $stmt->bindValue(':descricao', $descricao);
            if ($stmt->execute()){
                return $this->db->lastInsertId();
            }

            return false;
            
        }
    }

?>
