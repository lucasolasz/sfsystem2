<?php

class Usuarios extends Controller
{
    private $model;

    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        $this->model = $this->model("UsuarioModel");
    }

    public function cadastrar()
    {

        $tiposUsuario = $this->model->listarTipoUsuario();
        $cargoUsuario = $this->model->listarCargoUsuario();

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtNome' => trim($formulario['txtNome']),
                'txtSobreNome' => trim($formulario['txtSobreNome']),
                'txtEmail' => trim($formulario['txtEmail']),
                'txtSenha' => trim($formulario['txtSenha']),
                'txtConfirmaSenha' => trim($formulario['txtConfirmaSenha']),
                'cboTipoUsuario' => $formulario['cboTipoUsuario'],
                'cboCargoUsuario' => $formulario['cboCargoUsuario'],
                'tiposUsuario' => $tiposUsuario,
                'cargoUsuario' => $cargoUsuario,
                'nome_erro' => '',
                'email_erro' => '',
                'sobrenome_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => '',
                'tipoUsuario_erro' => '',
                'tipoCargo_erro' => ''
            ];

            if (in_array("", $formulario)) {

                //Verifica se está vazio
                if (empty($formulario['txtNome'])) {
                    $dados['nome_erro'] = "Preencha o Nome";
                }
                if(empty($formulario["txtSobreNome"])) {
                    $dados["txtSobreNome"] = "Preencha o sobrenome";
                }
                if (empty($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Preencha o email";
                }
                if ($formulario['cboTipoUsuario'] == 'NULL') {
                    $dados['tipoUsuario_erro'] = "Escolha um tipo de usuário";
                }
                if ($formulario['cboCargoUsuario'] == 'NULL') {
                    $dados['tipoCargo_erro'] = "Escolha um cargo de usuário";
                }
                if (empty($formulario['txtSenha'])) {
                    $dados['senha_erro'] = "Preencha a senha";
                }
                if (empty($formulario['txtConfirmaSenha'])) {
                    $dados['confirma_senha_erro'] = "Preencha a confirmação de senha";
                }
            } else {
                //Invoca método estatico da classe 
                if (Checa::checarNome($formulario['txtNome'])) {
                    $dados['nome_erro'] = "Nome inválido";
                } elseif (Checa::checarEmail($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Email inválido";
                } elseif ($this->model->checarEmailUsuario($dados)) {
                    $dados['email_erro'] = "Email já está sendo utilizado";
                } elseif (strlen($formulario['txtSenha']) < 6) {
                    $dados['senha_erro'] = "A senha precisa ter no mínimo 6 caracteres";
                } elseif ($formulario['txtSenha'] != $formulario['txtConfirmaSenha']) {
                    $dados['confirma_senha_erro'] = "As senhas são diferentes";
                } else {

                    //Criptografa a senha com hash em php
                    $dados['txtSenha'] = password_hash($formulario['txtSenha'], PASSWORD_DEFAULT);

                    if ($this->model->armazenarUsuario($dados)) {

                        //Para exibir mensagem success , não precisa informar o tipo de classe
                        Alertas::mensagem('usuario', 'Usuário cadastrado com sucesso');
                        Redirecionamento::redirecionar('usuarios/visualizarUsuarios');
                    } else {
                        die("Erro ao armazenar usuário no banco de dados");
                    }
                }
            }
        } else {
            $dados = [
                'txtNome' => '',
                'txtSobreNome' => '',
                'txtEmail' => '',
                'txtSenha' => '',
                'txtConfirmaSenha' => '',
                'nome_erro' => '',
                'sobrenome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => '',
                'tipoUsuario_erro' => '',
                'tipoCargo_erro' => '',
                'tiposUsuario' => $tiposUsuario,
                'cargoUsuario' => $cargoUsuario
            ];
        }

        //Retorna para a view
        $this->view('usuarios/cadastrar', $dados);
    }

    public function login()
    {
        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtEmail' => trim($formulario['txtEmail']),
                'txtSenha' => trim($formulario['txtSenha']),
                'txtNome' => '',
                'email_erro' => '',
                'senha_erro' => ''
            ];

            if (in_array("", $formulario)) {

                //Verifica se está vazio
                if (empty($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Preencha o email";
                }
                if (empty($formulario['txtSenha'])) {
                    $dados['senha_erro'] = "Preencha a senha";
                }
            } else {
                //Invoca método estatico da classe 
                if (Checa::checarEmail($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Email inválido";
                } elseif (strlen($formulario['txtSenha']) < 6) {
                    $dados['senha_erro'] = "A senha precisa ter no mínimo 6 caracteres";
                } else {

                    $usuario = $this->model->checarLogin($formulario['txtEmail'], $formulario['txtSenha']);

                    if ($usuario) {
                        $this->criarSessaoUsuario($usuario);
                    } else {
                        Alertas::mensagem('usuario', 'Usuário ou senha inválidos', 'alert alert-danger');
                    }
                }
            }
        } else {
            $dados = [
                'txtNome' => '',
                'txtEmail' => '',
                'txtSenha' => '',
                'email_erro' => '',
                'senha_erro' => ''
            ];
        }

        //Retorna para a view
        $this->view('usuarios/login', $dados);
    }

    //Cria as variaveis de sessao ao fazer login, resgatando informações do usuário
    private function criarSessaoUsuario($usuario)
    {
        $_SESSION['id_usuario'] = $usuario->id_usuario;
        $_SESSION['ds_nome_usuario'] = $usuario->ds_nome_usuario;
        $_SESSION['ds_email_usuario'] = $usuario->ds_email_usuario;
        $_SESSION['fk_cargo'] = $usuario->fk_cargo;
        $_SESSION['fk_tipo_usuario'] = $usuario->fk_tipo_usuario;

        Redirecionamento::redirecionar('paginas/home');
    }


    //Destroi todas as variáveis de sessão para efetuar logof
    public function sair()
    {
        unset($_SESSION['id_usuario']);
        unset($_SESSION['ds_nome_usuario']);
        unset($_SESSION['ds_email_usuario']);
        unset($_SESSION['fk_cargo']);
        unset($_SESSION['fk_tipo_usuario']);

        session_destroy();

        Redirecionamento::redirecionar('usuarios/login');
    }

    public function visualizarUsuarios()
    {
        $usuarios =  $this->model->visualizarUsuarios();

        $dados = [
            'usuarios' => $usuarios,
            'tituloBreadcrumb' => ''
        ];

        //Retorna para a view
        $this->view('usuarios/visualizar', $dados);
    }

    public function editarUsuario($id)
    {

        $tiposUsuario = $this->model->listarTipoUsuario();
        $cargoUsuario = $this->model->listarCargoUsuario();
        $usuario = $this->model->lerUsuarioPorId($id);

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtNome' => trim($formulario['txtNome']),
                'txtSobreNome' => trim($formulario['txtSobreNome']),
                'txtEmail' => trim($formulario['txtEmail']),
                'txtSenha' => trim($formulario['txtSenha']),
                'txtConfirmaSenha' => trim($formulario['txtConfirmaSenha']),
                'cboTipoUsuario' => $formulario['cboTipoUsuario'],
                'cboCargoUsuario' => $formulario['cboCargoUsuario'],
                'idUsuario' => $id
            ];


            //Verifica se está vazio
            if (empty($formulario['txtNome'])) {
                $dados['nome_erro'] = "Preencha o Nome";
            }
            if(empty($formulario["txtSobreNome"])) {
                $dados["txtSobreNome"] = "Preencha o sobrenome";
            }
            if (empty($formulario['txtEmail'])) {
                $dados['email_erro'] = "Preencha o email";
            }
            if ($formulario['cboTipoUsuario'] == 'NULL') {
                $dados['tipoUsuario_erro'] = "Escolha um tipo de usuário";
            }
            if ($formulario['cboCargoUsuario'] == 'NULL') {
                $dados['tipoCargo_erro'] = "Escolha um cargo de usuário";
            }
            //Invoca método estatico da classe 
            if (Checa::checarNome($formulario['txtNome'])) {
                $dados['nome_erro'] = "Nome inválido";
            } elseif (Checa::checarEmail($formulario['txtEmail'])) {
                $dados['email_erro'] = "Email inválido";
            } elseif ($this->model->checarEmailUsuario($dados)) {
                $dados['email_erro'] = "Email já está sendo utilizado";
            }

            if ($formulario['txtSenha'] != "") {
                if (strlen($formulario['txtSenha']) < 6) {
                    $dados['senha_erro'] = "A senha precisa ter no mínimo 6 caracteres";
                } elseif ($formulario['txtSenha'] != $formulario['txtConfirmaSenha']) {
                    $dados['confirma_senha_erro'] = "As senhas são diferentes";
                }
                //Criptografa a senha com hash em php
                $dados['txtSenha'] = password_hash($formulario['txtSenha'], PASSWORD_DEFAULT);

                if ($this->model->atualizarUsuarioComSenha($dados)) {
                    //Para exibir mensagem success , não precisa informar o tipo de classe
                    Alertas::mensagem('usuario', 'Usuário atualizado com sucesso');
                    Redirecionamento::redirecionar('Usuarios/visualizarUsuarios');
                } else {
                    Alertas::mensagem('usuario', 'Usuário atualizado com sucesso', 'alert alert-danger');
                }
            } else {
                if ($this->model->atualizarUsuarioSemSenha($dados)) {

                    //Para exibir mensagem success , não precisa informar o tipo de classe
                    Alertas::mensagem('usuario', 'Usuário atualizado com sucesso');
                    Redirecionamento::redirecionar('Usuarios/visualizarUsuarios');
                } else {
                    Alertas::mensagem('usuario', 'Usuário atualizado com sucesso', 'alert alert-danger');
                }
            }
        } else {
            $dados = [
                'txtNome' => '',
                'txtSobreNome' => '',
                'txtEmail' => '',
                'txtSenha' => '',
                'txtConfirmaSenha' => '',
                'nome_erro' => '',
                'sobrenome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => '',
                'tipoUsuario_erro' => '',
                'tipoCargo_erro' => '',
                'tiposUsuario' => $tiposUsuario,
                'cargoUsuario' => $cargoUsuario,
                'usuario' => $usuario,
            ];
        }

        //Retorna para a view
        $this->view('usuarios/editar', $dados);
    }

    public function deletarUsuario($id)
    {

        if ($this->model->deletarUsuario($id)) {

            //Para exibir mensagem success , não precisa informar o tipo de classe
            Alertas::mensagem('usuario', 'Usuário deletado com sucesso');
            Redirecionamento::redirecionar('Usuarios/visualizarUsuarios');
        } else {
            Alertas::mensagem('usuario', 'Não foi possível deletar o usuário', 'alert alert-danger');
            Redirecionamento::redirecionar('Usuarios/visualizarUsuarios');
        }
    }
}
