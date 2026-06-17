<?php

    class UsuarioView {
        
        public function sendResponse($data, $statuscode) {
            if (ob_get_length()) ob_clean();
            header("Content-Type: application/json; charset=utf-8");
            http_response_code($statuscode);
            echo json_encode($data);
            exit;
        }
    }

