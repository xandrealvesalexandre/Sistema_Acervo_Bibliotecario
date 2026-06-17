<?php
    ob_start();
    // Configurações de Erro
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    //cabeçalho da API:
    // definição para retorno (API) arquivo JSON
    header("Content-Type: application/json; charset=utf-8");
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '*'; // API recebe aquisições de qualquer domínio
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit;
    }


    // Importação de codigos
    require_once '../config/db.php';
    require_once '../app/controller/UsuarioController.php';
    require_once '../app/controller/LivroController.php';

    $database = new Database();
    $db = $database->getConnection();

    // Recuperar URL, limpa a URL, e prepara a rota
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
                    exit;
                } elseif ($method === "POST") {
                    $livroController->createLivro();
                    exit;
                } elseif ($method === "PUT") {
                    $livroController = new LivroController($db);
                    $livroController->updateLivro();
                    exit;
                }else {
                    http_response_code(405);
                    echo json_encode(["error" => "Método não permitido"]);
                }
                break;

            case 'livroTitulo':
                if ($method === "GET") {
                    $livroController = new LivroController($db);
                    $livroController->getLivrosPeloTitulo();
                    exit;
                }
                http_response_code(405); //Metodo nao permitido
                echo json_encode(["error" => "Método não permitido"]);
                break;
            
            case 'livroId':
                if ($method === "GET") {
                    $livroController = new LivroController($db);
                    $livroController->getLivrosPeloId();
                    exit;
                }
                http_response_code(405); //Metodo nao permitido
                echo json_encode(["error" => "Método não permitido"]);
                break;

            default:
                http_response_code(404);
                echo json_encode(["error" => "Rota não encontrada", "route" => $route]);
                break;
        }
    } catch (Throwable $e) { 
        // Throwable é a interface base para erros e exceções no PHP 7+
        http_response_code(500);
        echo json_encode([
            "error" => "Erro interno do servidor",
            "detail" => $e->getMessage()
        ]);
    }
