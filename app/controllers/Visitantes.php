<?php

class Visitantes extends Controller
{
    private $model;

    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        $this->model = $this->model("VisitanteModel");
    }

    public function cadastrar()
    {

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtNome' => trim($formulario['txtNome']),
                'txtDocumento' => trim($formulario['txtDocumento']),
                'txtTelefoneUm' => trim($formulario['txtTelefoneUm']),
                'txtTelefoneDois' => $formulario['txtTelefoneDois'],
                'nome_erro' => '',
                'documento_erro' => ''
            ];

            if (in_array("", $formulario)) {

                //Verifica se está vazio
                if (empty($formulario['txtNome'])) {
                    $dados['nome_erro'] = "Preencha o Nome";
                }
                if (empty($formulario["txtDocumento"])) {
                    $dados["txtDocumento"] = "Preencha o documento";
                }
            } else {

                if ($this->model->armazenarVisitante($dados)) {

                    //Para exibir mensagem success , não precisa informar o tipo de classe
                    Alertas::mensagem('visitante', texto: 'Visitante cadastrado com sucesso');
                    Redirecionamento::redirecionar('Visitantes/visualizarVisitantes');
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
                'documento_erro' => ''
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
}
