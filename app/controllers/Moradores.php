<?php

class Moradores extends Controller
{

    private $model;

    private $casaModel;

    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        $permissoes = [ADMINISTRADOR, MORADOR];
        $this->verificaSeEstaLogadoETemPermissao($permissoes);
        $this->model = $this->model("MoradorModel");
        $this->casaModel = $this->model("CasaModel");
    }

    public function visualizarMoradores()
    {
        $moradores = $this->model->recuperarTodosOsMoradoresCadastrados();

        $dados = [
            'moradores' => $moradores
        ];

        //Retorna para a view
        $this->view('morador/visualizarTodos', $dados);
    }

    public function cadastrar()
    {

        $casas = $this->casaModel->reuperarTodasCasas();

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtNome' => trim($formulario['txtNome']),
                'txtDocumentoMoradorAtual' => trim($formulario['txtDocumentoMoradorAtual']),
                'dateNascimentoMorador' => $formulario['dateNascimentoMorador'],
                'txtEmail' => trim($formulario['txtEmail']),
                'txtTelefoneUm' => trim($formulario['txtTelefoneUm']),
                'txtTelefoneDois' => trim($formulario['txtTelefoneDois']),
                'txtTelefoneEmergencia' => trim($formulario['txtTelefoneEmergencia']),
                'cboCasa' => $formulario['cboCasa'],
                'nome_erro' => '',
                'documento_erro' => '',
                'dataNascimentoMorador_erro' => '',
                'email_erro' => '',
                'telefone_um_erro' => '',
                'cboCasa_erro' => '',
                'casas' => $casas
            ];

            if (empty($formulario['txtNome'])) {
                $dados['nome_erro'] = "Preencha o Nome";
            } elseif (empty($formulario["txtDocumentoMoradorAtual"])) {
                $dados["documento_erro"] = "Preencha o documento";
            } elseif (empty($formulario['dateNascimentoMorador'])) {
                $dados["dataNascimentoMorador_erro"] = "Escolha uma data";
            } elseif (empty($formulario['txtEmail'])) {
                $dados["email_erro"] = "Preencha um email";
            } elseif (empty($formulario['txtTelefoneUm'])) {
                $dados["telefone_um_erro"] = "Preencha um telefone";
            } elseif (empty($formulario['cboCasa'])) {
                $dados["cboCasa_erro"] = "Escolha uma casa";
            } else {

                $this->model->armazenarMorador($dados);
                Alertas::mensagem('morador', 'Morador cadastrado com sucesso');
                Redirecionamento::redirecionar('Moradores/visualizarMoradores');
            }
        } else {

            $dados = [
                'txtNome' => '',
                'txtDocumentoMoradorAtual' => '',
                'dateNascimentoMorador' => '',
                'txtEmail' => '',
                'txtTelefoneUm' => '',
                'txtTelefoneDois' => '',
                'txtTelefoneEmergencia' => '',
                'cboCasa' => '',
                'nome_erro' => '',
                'documento_erro' => '',
                'dataNascimentoMorador_erro' => '',
                'email_erro' => '',
                'telefone_um_erro' => '',
                'cboCasa_erro' => '',
                'casas' => $casas
            ];
        }

        $this->view('morador/cadastrar', $dados);
    }
}
