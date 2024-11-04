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
        $data = json_decode(file_get_contents('php://input'), true);

        // Recebe parâmetros do DataTables
        $inicio = $data['start'];
        $quantidade = $data['length'];
        $valorBusca = $data['search'];
        $colunaOrdenacao = $data['order'][0]['column'];
        $direcaoOrdenacao = $data['order'][0]['dir'];

        $tabela = $data['tabela'];
        $listaColunasPesquisa = $data['colunas_pesquisa'];
        $listaColunaOrdenacao = $data['colunas_ordenacao'];  

        // Consulta total de registros sem filtros
        $totalRegistros = $this->model->contarVisitantes();

        // Consulta com filtros e ordenação
        $visitantes = $this->model->obterVisitantesPaginados(
            $inicio,
            $quantidade,
            $valorBusca,
            $colunaOrdenacao,
            $direcaoOrdenacao,
            $tabela,
            $listaColunasPesquisa,
            $listaColunaOrdenacao
        );

        // Formata a resposta
        $resposta = [
            "draw" => intval($data['draw']),
            "recordsTotal" => $totalRegistros,
            "recordsFiltered" => count($visitantes), // Pode ajustar conforme os filtros
            "data" => $visitantes
        ];

        // Envia como JSON
        header('Content-Type: application/json');
        echo json_encode($resposta);
    }

}