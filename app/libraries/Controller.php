<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $dados = [])
    {
        $arquivo = ('../app/views/' . $view . '.php');
        include APP . '/views/topo.php';

        if (file_exists($arquivo)) {
            require_once $arquivo;
        } else {
            die('O arquivo de view não existe!');
        }
        include APP . '/views/rodape.php';
    }

    public function verificaSeEstaLogado()
    {
        if (!IsLoged::estaLogado()) {
            Redirecionamento::redirecionar('Paginas/paginaErro');
        }
    }
}
