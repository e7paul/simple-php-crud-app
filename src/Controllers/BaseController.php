<?php

namespace src\Controllers;

class BaseController {
    protected function render($view, $data = []): void {
        extract($data);
        $path = "src/Views/$view.html";

        include "src/Views/base.html";
    }

    /**
     * @param int $code
     * @param string $message
     * @return void
     */
    protected function throw(int $code, string $message): void
    {
        http_response_code($code);
        $this->render('message', ['code' => $code, 'message' => $message]);
    }
}