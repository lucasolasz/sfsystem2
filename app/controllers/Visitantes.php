<?php

class Visitantes extends Controller
{
    private $model;
    private $modelVeiculo;

    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        $this->verificaSeEstaLogado();

        $this->model = $this->model("VisitanteModel");
        $this->modelVeiculo = $this->model("VeiculoModel");
    }

    public function cadastrar()
    {

        $listaTiposVeiculos = $this->modelVeiculo->recuperarTiposVeiculos();
        $listaCoresVeiculos = $this->modelVeiculo->recuperarCoresVeiculos();

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $listaVeiculosCadastradosForm = $this->recuperarVeiculosFormulario($formulario);

            $dados = [
                'txtNome' => trim($formulario['txtNome']),
                'txtDocumento' => trim($formulario['txtDocumento']),
                'txtTelefoneUm' => trim($formulario['txtTelefoneUm']),
                'txtTelefoneDois' => $formulario['txtTelefoneDois'],
                'nome_erro' => '',
                'documento_erro' => '',
                'listaTiposVeiculos' => $listaTiposVeiculos,
                'listaCoresVeiculos' => $listaCoresVeiculos

            ];

            //Verifica se está vazio
            if (empty($formulario['txtNome'])) {
                $dados['nome_erro'] = "Preencha o Nome";
            } elseif (empty($formulario["txtDocumento"])) {
                $dados["txtDocumento"] = "Preencha o documento";
            } else {

                if ($this->model->armazenarVisitante($dados)) {

                    $idVisitante = $this->model->ultimoIdInserido();

                    if ($this->modelVeiculo->armazenarCarrosVisitante($listaVeiculosCadastradosForm, $idVisitante)) {
                        Alertas::mensagem('visitante', texto: 'Visitante cadastrado com sucesso');
                        Redirecionamento::redirecionar('Visitantes/visualizarVisitantes');
                    }

                } else {
                    die("Erro ao armazenar visitante no banco de dados");
                }
            }
        } else {
            $dados = [
                'txtNome' => '',
                'txtDocumento' => '',
                'txtTelefoneUm' => '',
                'txtTelefoneDois' => '',
                'nome_erro' => '',
                'documento_erro' => '',
                'listaTiposVeiculos' => $listaTiposVeiculos,
                'listaCoresVeiculos' => $listaCoresVeiculos

            ];
        }

        //Retorna para a view
        $this->view('visitantes/cadastrar', $dados);
    }

    public function visualizarVisitantes()
    {
        $visitantes = $this->model->visualizarVisitantes();

        $dados = [
            'visitantes' => $visitantes
        ];

        //Retorna para a view
        $this->view('visitantes/visualizar', $dados);
    }

    public function editarVisitante($id)
    {

        $visitante = $this->model->retornarVisitantePorId($id);

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtNome' => trim($formulario['txtNome']),
                'txtDocumento' => trim($formulario['txtDocumento']),
                'txtTelefoneUm' => trim($formulario['txtTelefoneUm']),
                'txtTelefoneDois' => $formulario['txtTelefoneDois'],
                'nome_erro' => '',
                'documento_erro' => '',
                'idVisitante' => $id
            ];

            if ($this->model->atualizarVisitante($dados)) {
                Alertas::mensagem('visitante', 'Visitante atualizado com sucesso');
                Redirecionamento::redirecionar('Visitantes/visualizarVisitantes');
            }

        } else {
            $dados = [
                'txtNome' => '',
                'txtDocumento' => '',
                'txtTelefoneUm' => '',
                'txtTelefoneDois' => '',
                'nome_erro' => '',
                'documento_erro' => '',
                'visitante' => $visitante
            ];
        }

        //Retorna para a view
        $this->view('visitantes/editar', $dados);
    }

    private function recuperarVeiculosFormulario($formulario)
    {

        $listaVeiculosSaida = [];

        // Iterar pelos índices dos veículos
        foreach ($formulario as $key => $value) {
            // Verifica se a chave contém o prefixo "tipo_veiculo_"
            if (strpos($key, 'tipo_veiculo_') === 0) {
                // Extrair o número do veículo a partir da chave
                $index = str_replace('tipo_veiculo_', '', $key);

                // Verificar se existem os campos correspondentes para "placa" e "cor"
                if (isset($formulario["placa_veiculo_$index"]) && isset($formulario["cor_veiculo_$index"])) {
                    // Criar um array associativo para o veículo
                    $listaVeiculosSaida[] = [
                        'fk_tipo_veiculo' => $formulario["tipo_veiculo_$index"],
                        'ds_placa_veiculo' => $formulario["placa_veiculo_$index"],
                        'fk_cor_veiculo' => $formulario["cor_veiculo_$index"]
                    ];
                }
            }
        }

        return $listaVeiculosSaida;
    }
}
