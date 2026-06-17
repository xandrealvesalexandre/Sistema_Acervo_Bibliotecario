<?php

    require_once "../app/model/LivroModel.php";
    require_once "../app/view/LivroView.php";
    require_once "../app/model/EstoqueModel.php";

   class LivroController {
        private $modelLivro;
        private $viewLivro;
        private $db;
        private $modelEstoque;

        public function __construct($db) {
            $this->db = $db;
            //Conectar no DB e instanciar o model e consultar os livros
            $this->modelLivro = new LivroModel($db);

            //Instanciar a view
            $this->viewLivro = new LivroView();

            $this->modelEstoque = new EstoqueModel($db);
        }

        public function getLivros() {
            $livros = $this->modelLivro->buscarLivros();
            $this->viewLivro->sendResponse($livros, 200);
        }

        public function getLivrosPeloTitulo() {
            $titulo = $_GET['titulo'] ?? null;
            if ($titulo) {
                $data = $this->modelLivro->getLivrosPeloTitulo($titulo);
                $this->viewLivro->sendResponse($data, 200);
            } else {
                $this->viewLivro->sendResponse([
                    'message' => 'Por favor, insira um título válido.'
                ], 400);
            }
        }

        public function getLivrosPeloId() {
            $id = $_GET['id'] ?? null;

            if (isset($id)) {
                $livro = $this->modelLivro->getLivroPeloId($id);
                $this->viewLivro->sendResponse($livro, 200);
            } else {
                $this->viewLivro->sendResponse([
                    'message' => 'Por favor, insira um id válido.'
                ], 400);
            }

        }

        public function createLivro() {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if ( isset($data['titulo']) && 
                    isset($data['descricao']) && 
                    isset($data['autor'])) {
                    try {
                         $this->db->beginTransaction();
                        $idLivro = $this->modelLivro->createLivro(
                                $data['titulo'],
                                $data['autor'],
                                $data['descricao']
                            );

                            if (!$idLivro) {
                                throw new Exception("Erro ao cadastrar livro");
                            }
                            $estoqueCriado = $this->modelEstoque->createEstoque($idLivro, 0);

                            if (!$estoqueCriado) {
                                throw new Exception("Erro ao cadastrar estoque");
                            }

                            $this->db->commit();
                            $this->viewLivro->sendResponse([
                                'message' => 'Livro cadastrado com sucesso.',
                                'id_livro' => $idLivro
                            ]);
                    } catch (Exception $e) {
                        if ($this->db->inTransaction()){
                            $this->db->rollBack();
                        }
                            
                        
                        $this->viewLivro->sendResponse([
                            'error' => 'Erro ao cadastrar livro.',
                            'detail' => $e->getMessage()
                        ], 400);
                    }  
            } else {
                $this->viewLivro->sendResponse([
                    'message' => 'Dados incompletos.'
                ], 400);
            }   

        }

        public function updateLivro() {
            $data = json_decode(file_get_contents('php://input'), true);
            if ( isset($data['id']) && 
                    isset($data['titulo']) && 
                    isset($data['descricao']) && 
                    isset($data['autor'])) {
            $result = $this->modelLivro->updateLivro($data['id'], $data['titulo'], $data['autor'], $data['descricao']);
                    $this->viewLivro->sendResponse([
                        'message' => 'Livro atualizado com sucesso.',
                        'id_livro' => $data['id']
                    ], 200);    
            } else {
                $this->viewLivro->sendResponse([
                    'message' => 'Dados incompletos.'
                ], 400);
            }

        }
    }
?>
