<?php

class Paginas extends Controller 
{
    public function index(){

        //Parâmetros enviados para o método do controller VIEW
        $dados = [
            'tituloPagina' => 'Página Inicial',
        ];

        //Chamada do novo objeto PAGINAS 
        $this->view('paginas/home', $dados);
    }
}