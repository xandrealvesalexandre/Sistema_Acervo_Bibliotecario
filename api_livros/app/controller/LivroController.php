<?php

   class LivroController {
        private $modelLivro;
        private $viewLivro;

        public function __construct($db) {
            //Conectar no DB e instanciar o model e consultar os livros
            $this->modelLivro = new LivroModel($db);

            //Instanciar a view
            $this->viewLivro = new LivroView();
        }

        public function getLivros() {
            $livros = $this->modelLivro->buscarLivros();
            $this->viewLivro->sendResponse($livros, 200);
        }
   } 

?>