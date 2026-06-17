<?php

    class LivroView {

        public function sendResponse($data, $statuscode=200) {
           if (ob_get_length()) ob_clean();
           http_response_code($statuscode);
           header('Content-Type: application/json; charset=utf-8');
           echo json_encode($data);
           exit;
        }
    }

