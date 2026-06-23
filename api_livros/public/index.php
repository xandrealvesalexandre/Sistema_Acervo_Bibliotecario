<?php
    ob_start();
    // Configurações de Erro
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    //cabeçalho da API:
    header("Content-Type: application/json; charset=utf-8");
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit;
    }

    require_once '../config/db.php';
    require_once '../app/controller/UsuarioController.php';
    require_once '../app/controller/LivroController.php';
    require_once '../app/controller/EstoqueController.php';

    $database = new Database();
    $db = $database->getConnection();

    $path = parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH);
    $route = basename($path);
    $method = $_SERVER['REQUEST_METHOD'];

    try {
        switch ($route) {
            case 'health':
                echo json_encode(["status" => "OK - Sistema Online!"]);
                http_response_code(200);
                break;

            case 'login':
                if ($method === "POST") {
                    $usuarioController = new UsuarioController($db);
                    $usuarioController->loginUsuario(); 
                } else {
                    http_response_code(405);
                    echo json_encode(["error" => "Método não permitido"]);
                }
                break;

            case 'livros':
                $livroController = new LivroController($db);
                if ($method === "GET") {
                    $livroController->getLivros();
                } elseif ($method === "POST") {
                    $livroController->createLivro();
                } elseif ($method === "PUT") {
                    $livroController->updateLivro();
                } elseif ($method === "DELETE") {
                    $livroController->deleteLivro();
                } else {
                    http_response_code(405);
                    echo json_encode(["error" => "Método não permitido"]);
                }
                exit;
                break;

            case 'livroTitulo':
                if ($method === "GET") {
                    $livroController = new LivroController($db);
                    $livroController->getLivrosPeloTitulo();
                    exit;
                }
                http_response_code(405);
                echo json_encode(["error" => "Método não permitido"]);
                break;
            
            case 'livroId':
                $livroController = new LivroController($db);
                if ($method === "GET") {
                    $livroController->getLivrosPeloId();
                } elseif ($method === "PUT") {
                    $livroController->updateLivro();
                } elseif ($method === "DELETE") {
                    $livroController->deleteLivro();
                } else {
                    http_response_code(405);
                    echo json_encode(["error" => "Método não permitido"]);
                }
                exit;
                break;

            case 'estoque':
                $estoqueController = new EstoqueController($db);
                if ($method === "PUT" || $method === "POST") {
                    $estoqueController->atualizarSaldo();
                    exit;
                }
                http_response_code(405);
                echo json_encode(["error" => "Método não permitido"]);
                break;

            default:
                http_response_code(404);
                echo json_encode(["error" => "Rota não encontrada", "route" => $route]);
                break;
        }
    } catch (Throwable $e) { 
        http_response_code(500);
        echo json_encode([
            "error" => "Erro interno do servidor",
            "detail" => $e->getMessage()
        ]);
    }
