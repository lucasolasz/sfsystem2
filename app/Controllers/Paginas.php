<?php

class Paginas extends Controller 
{
    public function index(){

        //Parâmetros enviados para o método do controller VIEW
        $dados = [
            'tituloPagina' => 'Página Inicial',
            'descricao' => 'Curso de PHP'
        ];

        //Chamada do novo objeto PAGINAS 
        $this->view('paginas/home', $dados);
    }


    public function sobre(){

        //Parâmetros enviados para o método do controller VIEW
        $dados = [
            'tituloPagina' => 'Sobre nós'            
        ];

        //Chamada do novo objeto PAGINAS 
        $this->view('paginas/sobre', $dados);

        
    }
}