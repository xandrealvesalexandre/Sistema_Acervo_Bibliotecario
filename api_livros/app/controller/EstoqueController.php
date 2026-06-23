<?php

    require_once '../app/model/EstoqueModel.php';
    require_once '../app/view/EstoqueView.php';

    class EstoqueController {
        private $modelEstoque;
        private $viewEstoque;
        private $db;

        public function __construct($db) {
            $this->db = $db;
            $this->modelEstoque = new EstoqueModel($db);
            $this->viewEstoque = new EstoqueView();
        }

        public function atualizarSaldo() {
            $data = json_decode(file_get_contents('php://input'), true);
            if(
                isset($data['id_livro']) &&
                isset($data['quantidade_atual']) &&
                isset($data['tipo']) &&
                isset($data['quantidade'])
            ){
                $nova_quantidade = $this->calculoQuantidade(
                    $data['quantidade'], 
                    $data['quantidade_atual'], 
                    $data['tipo']
                );

                $result = $this->modelEstoque->updateEstoque($data['id_livro'], $nova_quantidade);
                
                if ($result) {
                    if ($nova_quantidade <= 5){
                        $this->viewEstoque->sendResponse([
                            'message' => 'Estoque atualizado. Atenção: Livro em estoque crítico.',
                            'id_livro' => $data['id_livro'],
                            'nova_quantidade' => $nova_quantidade
                        ], 200);
                    } else {
                        $this->viewEstoque->sendResponse([
                            'message' => 'Estoque atualizado com sucesso.',
                            'id_livro' => $data['id_livro'],
                            'nova_quantidade' => $nova_quantidade
                        ], 200);
                    }
                } else {
                    $this->viewEstoque->sendResponse([
                        'message' => 'Erro ao atualizar o estoque no banco de dados.'
                    ], 500);
                }
            } else {
                $this->viewEstoque->sendResponse([
                    'message' => 'Dados insuficientes. Tente novamente. Confira se os campos foram preenchidos corretamente.'
                ], 400);
            }
        }

        private function calculoQuantidade($quantidade, $quantidade_atual, $tipo) {
            $quantidade = (int)$quantidade;
            $quantidade_atual = (int)$quantidade_atual;

            if($tipo == 'saida' && $quantidade > $quantidade_atual) {
                $this->viewEstoque->sendResponse([
                    'message' => 'Quantidade indisponível para retirada.'
                ], 400);
                exit;
            }

            switch ($tipo) {
                case 'entrada':
                    return $quantidade_atual + $quantidade;
                case 'saida':
                    return $quantidade_atual - $quantidade;
                default:
                    return $quantidade_atual;
            }
        }
    }
