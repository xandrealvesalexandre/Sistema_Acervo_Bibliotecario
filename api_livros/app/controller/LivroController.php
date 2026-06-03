<?php

    require_once "../app/model/LivroModel.php";
    require_once "../app/view/LivroView.php";

   class LivroController {
        private $modelLivro;
        private $viewLivro;
        private $db;

        public function __construct($db) {
            $this->db = $db;
            //Conectar no DB e instanciar o model e consultar os livros
            $this->modelLivro = new LivroModel($db);

            //Instanciar a view
            $this->viewLivro = new LivroView();
        }

        public function getLivros() {
            $livros = $this->modelLivro->buscarLivros();
            $this->viewLivro->sendResponse($livros, 200);
        }

        public function getLivrosPeloTitulo() {
            $titulo = $_GET['titulo'];
            if(isset($titulo)) {
                $data = $this->modelLivro->getLivrosPeloTitulo($titulo);
                $this->viewLivro->sendResponse($data, 200);
            } else {
                $this->viewLivro->sendResponse([
                    'message' => 'Por favor, insira um título válido.'
                ], 400);
            }
        }

        public function createLivro() {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if ( isset($data['titulo']) && 
                    isset($data['descricao']) && 
                    isset($data['autor'])) {

                $this->db->beginTransaction();
                $this->modelLivro->createLivro($data);
            }
        }
   } 

?>
