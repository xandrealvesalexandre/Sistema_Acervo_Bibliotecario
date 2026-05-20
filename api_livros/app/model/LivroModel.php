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
                INNER JOIN Estoque ON Livros.id_livro = Estoque.id_livro;"
            );
          
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>