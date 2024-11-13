<?php

class Visitas extends Controller
{
    private $modelVisitante;

    private $modelVeiculo;

    private $visitaModel;

    private $tipoVisitaModel;

    private $casaModel;

    public function __construct()
    {
        $this->verificaSeEstaLogado();

        $this->modelVisitante = $this->model("VisitanteModel");
        $this->modelVeiculo = $this->model("VeiculoModel");
        $this->visitaModel = $this->model("VisitaModel");
        $this->tipoVisitaModel = $this->model("TipoVisitaModel");
        $this->casaModel = $this->model("CasaModel");
    }


    public function carregarTelaCadastroVisita($idVisitante)
    {

        $visitante = $this->modelVisitante->retornarVisitantePorId($idVisitante);
        $veiculos = $this->modelVeiculo->recuperarTodosVeiculosPorIdVisitante($idVisitante);
        $tipoVisita = $this->tipoVisitaModel->recuperarTodosTipoVisita();
        $listaCasas = $this->casaModel->reuperarTodasCasas();


        $dados = [
            'idVisitante' => $idVisitante,
            'visitante' => $visitante,
            'veiculos' => $veiculos,
            'tipoVisita' => $tipoVisita,
            'listaCasas' => $listaCasas,
            'cboTipoVisita_erro' => '',
            'cboCasas_erro' => ''
        ];

        //Retorna para a view
        $this->view('visita/cadastrar', $dados);
    }

    public function cadastrar($idVisitante)
    {

        $visitante = $this->modelVisitante->retornarVisitantePorId($idVisitante);
        $veiculos = $this->modelVeiculo->recuperarTodosVeiculosPorIdVisitante($idVisitante);
        $tipoVisita = $this->tipoVisitaModel->recuperarTodosTipoVisita();
        $listaCasas = $this->casaModel->reuperarTodasCasas();

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            date_default_timezone_set('America/Sao_Paulo');
            $anoMesDia = date("Y-m-d");
            $horaMinutoSegundo = date("H:i:s");

            $dados = [
                'qt_pessoas_carro' => trim($formulario['numQtdPessoasCarro']),
                'fk_veiculo' => $formulario['cboPlacaVeiculo'],
                'fk_tipo_visita' => trim($formulario['cboTipoVisita']),
                'fk_visitante' => $idVisitante,
                'fk_casa' => $formulario['cboCasas'],
                'fk_usuario_entrada' => $_SESSION['id_usuario'],
                'dt_entrada_visita' => $anoMesDia,
                'dt_hora_entrada_visita' => $horaMinutoSegundo,
                'observacao_visita' => trim($formulario['txtObervacao']),
                'idVisitante' => $idVisitante,
                'visitante' => $visitante,
                'veiculos' => $veiculos,
                'tipoVisita' => $tipoVisita,
                'listaCasas' => $listaCasas,
                'cboTipoVisita_erro' => '',
                'cboCasas_erro' => ''
            ];

            if (empty($formulario['cboTipoVisita'])) {
                $dados['cboTipoVisita_erro'] = "Escolha um tipo de visita";
            }
            if (empty($formulario["cboCasas"])) {
                $dados["cboCasas_erro"] = "Escolha uma casa";
            } else {

                $this->visitaModel->armazenarVisita($dados);
                Alertas::mensagem('visita', texto: 'Visitante cadastrado com sucesso');
                Redirecionamento::redirecionar('Visitas/visualizarVisitasEmAndamento');
            }
        } else {

            $dados = [
                'idVisitante' => $idVisitante,
                'visitante' => $visitante,
                'veiculos' => $veiculos,
                'tipoVisita' => $tipoVisita,
                'listaCasas' => $listaCasas,
                'cboTipoVisita_erro' => '',
                'cboCasas_erro' => ''
            ];
        }

        //Retorna para a view
        $this->view('visita/cadastrar', $dados);
    }


    public function visualizarVisitasEmAndamento()
    {

        $visitas = $this->visitaModel->visualizarVisitasEmAndamento();

        $dados = [
            'visitas' => $visitas
        ];

        //Retorna para a view
        $this->view('visita/visualizar', $dados);
    }
}
