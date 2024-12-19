<?php

class Moradores extends Controller
{

    private $model;

    private $casaModel;

    private $modelVeiculo;

    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        $permissoes = [ADMINISTRADOR, MORADOR];
        $this->verificaSeEstaLogadoETemPermissao($permissoes);
        $this->model = $this->model("MoradorModel");
        $this->casaModel = $this->model("CasaModel");
        $this->modelVeiculo = $this->model("VeiculoModel");
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
        $listaTiposVeiculos = $this->modelVeiculo->recuperarTiposVeiculos();
        $listaCoresVeiculos = $this->modelVeiculo->recuperarCoresVeiculos();
        $casas = $this->casaModel->reuperarTodasCasas();

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $listaVeiculosCadastradosForm = VeiculosUtil::recuperarVeiculosFormulario($formulario);

            $dados = [
                'txtNomeProprietario' => trim($formulario['txtNomeProprietario']),
                'txtDocumentoProprietario' => trim($formulario['txtDocumentoProprietario']),
                'dateNascimentoProprietario' => $formulario['dateNascimentoProprietario'],
                'txtEmailProprietario' => trim($formulario['txtEmailProprietario']),
                'txtTelefoneUmProprietario' => trim($formulario['txtTelefoneUmProprietario']),
                'txtTelefoneDoisProprietario' => trim($formulario['txtTelefoneDoisProprietario']),
                'txtTelefoneEmergenciaProprietario' => trim($formulario['txtTelefoneEmergenciaProprietario']),
                'cboCasa' => $formulario['cboCasa'],

                'chkLocatario' => isset($formulario['chkLocatario']) ? trim($formulario['chkLocatario']) : "N",
                'txtNomeLocatario' => trim($formulario['txtNomeLocatario']),
                'txtDocumentoLocatario' => $formulario['txtDocumentoLocatario'],
                'dateNascimentoLocatario' => trim($formulario['dateNascimentoLocatario']),
                'txtEmailLocatario' => trim($formulario['txtEmailLocatario']),
                'txtTelefoneUmLocatario' => trim($formulario['txtTelefoneUmLocatario']),
                'txtTelefoneDoisLocatario' => trim($formulario['txtTelefoneDoisLocatario']),

                'qtdPets' => trim($formulario['qtdPets']) != "" ? intval($formulario['qtdPets']) : 0,
                'chkPossuiPets' => isset($formulario['chkPossuiPets']) ? trim($formulario['chkPossuiPets']) : "N",

                'qtdAdesivos' => trim($formulario['qtdAdesivos']) != "" ? intval($formulario['qtdAdesivos']) : 0,
                'chkRecebeuAdesivo' => isset($formulario['chkRecebeuAdesivo']) ? trim($formulario['chkRecebeuAdesivo']) : "N",


                'nomeProprietario_erro' => '',
                'documentoProprietario_erro' => '',
                'dataNascimentoProprieratio_erro' => '',
                'emailProprietario_erro' => '',
                'telefone_um_proprietario_erro' => '',
                'cboCasa_erro' => '',
                'nomeLocatario_erro' => '',
                'documentoLocatario_erro' => '',
                'dataNascimentoLocatario_erro' => '',
                'emailLocatario_erro' => '',
                'telefone_um_locatario_erro' => '',
                'casas' => $casas,
                'listaTiposVeiculos' => $listaTiposVeiculos,
                'listaCoresVeiculos' => $listaCoresVeiculos
            ];

            if (empty($formulario['txtNomeProprietario'])) {
                $dados['nomeProprietario_erro'] = "Preencha o Nome";
            } elseif (empty($formulario["txtDocumentoProprietario"])) {
                $dados["documentoProprietario_erro"] = "Preencha o documento";
            } elseif (empty($formulario['dateNascimentoProprietario'])) {
                $dados["dataNascimentoProprieratio_erro"] = "Escolha uma data";
            } elseif (empty($formulario['txtEmailProprietario'])) {
                $dados["emailProprietario_erro"] = "Preencha um email";
            } elseif (empty($formulario['txtTelefoneUmProprietario'])) {
                $dados["telefone_um_proprietario_erro"] = "Preencha um telefone";
            } elseif (empty($formulario['cboCasa'])) {
                $dados["cboCasa_erro"] = "Escolha uma casa";
            } else {

                $idRetorno = $this->executarQuerysCadastroMorador($listaVeiculosCadastradosForm, $dados);

                if (!empty($idRetorno)) {
                    Alertas::mensagem('morador', 'Morador cadastrado com sucesso');
                    Redirecionamento::redirecionar('Moradores/visualizarMoradores');
                } else {
                    Alertas::mensagem('morador', 'Algo deu errado. Se o problema persistir, contate o administrador do sistema.', 'alert alert-danger');
                    Redirecionamento::redirecionar('Moradores/visualizarMoradores');
                }
            }
        } else {

            $dados = [
                'txtNomeProprietario' => '',
                'txtDocumentoProprietario' => '',
                'dateNascimentoProprietario' => '',
                'txtEmailProprietario' => '',
                'txtTelefoneUmProprietario' => '',
                'txtTelefoneDoisProprietario' => '',
                'txtTelefoneEmergenciaProprietario' => '',

                'chkLocatario' => '',
                'txtNomeLocatario' => '',
                'txtDocumentoLocatario' => '',
                'dateNascimentoLocatario' => '',
                'txtEmailLocatario' => '',
                'txtTelefoneUmLocatario' => '',
                'txtTelefoneDoisLocatario' => '',
                'cboCasa' => '',
                'qtdPets' => '',
                'chkPossuiPets' => '',
                'qtdAdesivos' => '',
                'chkRecebeuAdesivo' => '',



                'nomeProprietario_erro' => '',
                'documentoProprietario_erro' => '',
                'dataNascimentoProprieratio_erro' => '',
                'emailProprietario_erro' => '',
                'telefone_um_proprietario_erro' => '',
                'cboCasa_erro' => '',

                'nomeLocatario_erro' => '',
                'documentoLocatario_erro' => '',
                'dataNascimentoLocatario_erro' => '',
                'emailLocatario_erro' => '',
                'telefone_um_locatario_erro' => '',


                'casas' => $casas,
                'listaTiposVeiculos' => $listaTiposVeiculos,
                'listaCoresVeiculos' => $listaCoresVeiculos

            ];
        }

        $this->view('morador/cadastrar', $dados);
    }

    private function executarQuerysCadastroMorador($listaVeiculosCadastradosForm, $dados)
    {
        $idMorador = null;

        if ($this->model->armazenarMorador($dados)) {

            $idMorador = $this->model->ultimoIdInserido();

            if (!empty($listaVeiculosCadastradosForm)) {
                $this->modelVeiculo->armazenarListaCarrosMorador($listaVeiculosCadastradosForm, $idMorador);
            }

            return $idMorador;
        }

        return $idMorador;
    }
}
