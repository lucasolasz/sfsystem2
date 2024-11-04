<?php

class ListarDataTable extends Controller
{
    private $model;
    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        $this->model = $this->model("VisitanteModel");
    }

    public function metodo()
    {
        // Recebe parâmetros do DataTables
        $inicio = $_GET['start'];
        $quantidade = $_GET['length'];
        $valorBusca = $_GET['search']['value'];
        $colunaOrdenacao = $_GET['order'][0]['column'];
        $direcaoOrdenacao = $_GET['order'][0]['dir'];

        // Consulta total de registros sem filtros
        $totalRegistros = $this->model->contarVisitantes();

        // Consulta com filtros e ordenação
        $visitantes = $this->model->obterVisitantesPaginados(
            $inicio,
            $quantidade,
            $valorBusca,
            $colunaOrdenacao,
            $direcaoOrdenacao
        );

        // Formata a resposta
        $resposta = [
            "draw" => intval($_GET['draw']),
            "recordsTotal" => $totalRegistros,
            "recordsFiltered" => $totalRegistros, // Pode ajustar conforme os filtros
            "data" => $visitantes
        ];

        // Envia como JSON
        header('Content-Type: application/json');
        echo json_encode($resposta);
    }

}