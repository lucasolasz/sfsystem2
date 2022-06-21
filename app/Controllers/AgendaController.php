<?php

class AgendaController extends Controller
{


    public function __construct()
    {
        //Redireciona para tela de login caso usuario nao esteja logado
        if (!IsLoged::estaLogado()) {
            Redirecionamento::redirecionar('usuariosController/login');
        }

        $this->agendaModel = $this->model('AgendaConvidado');
        $this->usuarioModel = $this->model('Usuario');
    }


    public function index()
    {
        $dados = [
            'eventos' => $this->agendaModel->listar()
        ];

        $this->view('agendaConvidados/index', $dados);
    }


    public function cadastrar()
    {

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            //Define campos que estão vazios como NULL
            if (empty($formulario['txtDataTreinamento'])) {
                $dataTreinamentoNull = NULL;
            } else {
                $dataTreinamentoNull = trim($formulario['txtDataTreinamento']);
            }
            if (empty($formulario['txtHoraTreinamento'])) {
                $horaTreinamentoNull = NULL;
            } else {
                $horaTreinamentoNull = trim($formulario['txtHoraTreinamento']);
            }
            if (empty($formulario['txtDataLive'])) {
                $dataLiveNull = NULL;
            } else {
                $dataLiveNull = trim($formulario['txtDataLive']);
            }
            if (empty($formulario['txtHoraLive'])) {
                $horaLiveNull = NULL;
            } else {
                $horaLiveNull = trim($formulario['txtHoraLive']);
            }


            $dados = [
                'txtNomeConvidado' => trim($formulario['txtNomeConvidado']),
                'txtDataEntrevistaEscrita' => trim($formulario['txtDataEntrevistaEscrita']),
                'txtLinkEntrevistaEscrita' => trim($formulario['txtLinkEntrevistaEscrita']),
                'txtDataTreinamento' => $dataTreinamentoNull,
                'txtHoraTreinamento' => $horaTreinamentoNull,
                'txtDataLive' => $dataLiveNull,
                'txtHoraLive' => $horaLiveNull,
                'txtLinkLive' => trim($formulario['txtLinkLive']),
                'id_usuario' => $_SESSION['id_usuario']
            ];

            // var_dump($dados);
            // exit();

            //Verifica se está vazio
            if (empty($formulario['txtNomeConvidado'])) {
                $dados['nome_erro'] = "Preencha o Nome do Convidado";
            }
            if (empty($formulario['txtDataEntrevistaEscrita'])) {
                $dados['dataEntrevista_erro'] = "Preencha a Data da Entrevista";
            }

            //Invoca método estatico da classe 
            if (Checa::checarNome($formulario['txtNomeConvidado'])) {
                $dados['nome_erro'] = "Nome inválido";
            } elseif (Checa::checarData($formulario['txtDataEntrevistaEscrita'])) {
                $dados['dataEntrevista_erro'] = "Data da Entrevista inválida";
            } else {

                if ($this->agendaModel->armazenarAgenda($dados)) {

                    //Para exibir mensagem success , não precisa informar o tipo de classe
                    Alertas::mensagem('agenda', 'Evento cadastrado com sucesso');
                    Redirecionamento::redirecionar('agendaController/index');
                } else {
                    die("Erro ao armazenar agenda no banco de dados");
                }
            }
        } else {
            $dados = [
                'txtNomeConvidado' => '',
                'txtDataEntrevistaEscrita' => '',
                'txtLinkEntrevistaEscrita' => '',
                'txtDataTreinamento' => '',
                'txtHoraTreinamento' => '',
                'txtDataLive' => '',
                'txtHoraLive' => '',
                'txtLinkLive' => '',
                'nome_erro' => '',
                'dataEntrevista_erro' => ''
            ];
        }


        $this->view('agendaConvidados/cadastrar', $dados);
    }

    public function editar($id)
    {

        $agenda = $this->agendaModel->lerPorId($id);
        $usuario = $this->usuarioModel->lerUsuarioPorId($agenda->fk_usuario);
        $usuarioEdicao = $this->usuarioModel->lerUsuarioPorId($agenda->fk_usuario_edicao);

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            //Define campos que estão vazios como NULL
            if (empty($formulario['txtDataTreinamento'])) {
                $dataTreinamentoNull = NULL;
            } else {
                $dataTreinamentoNull = trim($formulario['txtDataTreinamento']);
            }
            if (empty($formulario['txtHoraTreinamento'])) {
                $horaTreinamentoNull = NULL;
            } else {
                $horaTreinamentoNull = trim($formulario['txtHoraTreinamento']);
            }
            if (empty($formulario['txtDataLive'])) {
                $dataLiveNull = NULL;
            } else {
                $dataLiveNull = trim($formulario['txtDataLive']);
            }
            if (empty($formulario['txtHoraLive'])) {
                $horaLiveNull = NULL;
            } else {
                $horaLiveNull = trim($formulario['txtHoraLive']);
            }

            $dados = [
                'txtNomeConvidado' => trim($formulario['txtNomeConvidado']),
                'txtDataEntrevistaEscrita' => trim($formulario['txtDataEntrevistaEscrita']),
                'txtLinkEntrevistaEscrita' => trim($formulario['txtLinkEntrevistaEscrita']),
                'txtDataTreinamento' => $dataTreinamentoNull,
                'txtHoraTreinamento' => $horaTreinamentoNull,
                'txtDataLive' => $dataLiveNull,
                'txtHoraLive' =>  $horaLiveNull,
                'txtLinkLive' => trim($formulario['txtLinkLive']),
                'id_usuario' => $_SESSION['id_usuario'],
                'id_agenda_convidados' => $id,
                'agenda' => $agenda,
                'fk_usuario' => $usuario,
                'usuarioEdicao' => $usuarioEdicao
            ];

            // var_dump($dados);

            //Verifica se está vazio
            if (empty($formulario['txtNomeConvidado'])) {
                $dados['nome_erro'] = "Preencha o Nome do Convidado";
            }
            if (empty($formulario['txtDataEntrevistaEscrita'])) {
                $dados['dataEntrevista_erro'] = "Preencha a Data da Entrevista";
            }
            //Invoca método estatico da classe 
            if (Checa::checarNome($formulario['txtNomeConvidado'])) {
                $dados['nome_erro'] = "Nome inválido";
            } elseif (Checa::checarData($formulario['txtDataEntrevistaEscrita'])) {
                $dados['dataEntrevista_erro'] = "Data da Entrevista inválida";
            } else {

                if ($this->agendaModel->atualizarAgenda($dados)) {

                    //Para exibir mensagem success , não precisa informar o tipo de classe
                    Alertas::mensagem('agenda', 'Evento atualizado com sucesso');
                    Redirecionamento::redirecionar('agendaController/index');
                } else {
                    die("Erro ao atualizar a agenda no banco de dados");
                }
            }
        } else {

            $dados = [
                'txtNomeConvidado' => '',
                'txtDataEntrevistaEscrita' => '',
                'txtLinkEntrevistaEscrita' => '',
                'txtDataTreinamento' => '',
                'txtHoraTreinamento' => '',
                'txtDataLive' => '',
                'txtHoraLive' => '',
                'txtLinkLive' => '',
                'agenda' => $agenda,
                'fk_usuario' => $usuario,
                'usuarioEdicao' => $usuarioEdicao
            ];
        }

        $this->view('agendaConvidados/editar', $dados);
    }


    public function deletar($id)
    {

        $id = filter_var($id, FILTER_VALIDATE_INT);

        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        if ($id && $metodo == 'POST') {

            if ($this->agendaModel->deletarAgenda($id)) {

                //Para exibir mensagem success , não precisa informar o tipo de classe
                Alertas::mensagem('agenda', 'Evento deletado com sucesso');
                Redirecionamento::redirecionar('agendaController');
            } else {
                die("Erro ao deletar o evento da agenda no banco de dados");
            }
        } else {
            Alertas::mensagem('agenda', 'Não foi possível deletar o evento', 'alert alert-danger');
            Redirecionamento::redirecionar('agendaController');
        }
    }
}
