<?php

namespace App\Exceptions;

class LinkInvalido extends ErroExecucao {

    public function __construct() {
        $message = $this->create(func_get_args());
        parent::__construct($message);
    }
}