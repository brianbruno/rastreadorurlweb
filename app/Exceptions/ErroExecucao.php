<?php

namespace App\Exceptions;

use Exception;

abstract class ErroExecucao extends Exception {
    protected $id;
    protected $link;
    protected $details;
     
    public function __construct($message)     {
        parent::__construct($message);
    }
 
    protected function create(array $args)
    {
        $this->id = array_shift($args);
        $this->link = array_shift($args);
        $error = $this->errors($this->id, $this->link);
        $this->details = vsprintf($error['context'], $args);
        return $this->details;
    }
 
    private function errors($id, $link = "NENHUM LINK ENVIADO") {
        $data = [
            'sem_conteudo' => [
                'context'  => 'Não foi possível recuperar o link: '.$link,
            ]
            //   ...
        ];
        return $data[$id];
    }
}
