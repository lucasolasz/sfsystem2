<?php

class UsuariosController extends Controller
{
    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        $this->usuarioModel = $this->model("Usuario");
    }

    public function cadastrar()
    {

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtNome' => trim($formulario['txtNome']),
                'txtEmail' => trim($formulario['txtEmail']),
                'txtSenha' => trim($formulario['txtSenha']),
                'txtConfirmaSenha' => trim($formulario['txtConfirmaSenha'])
            ];
            // var_dump($formulario);


            if (in_array("", $formulario)) {

                //Verifica se está vazio
                if (empty($formulario['txtNome'])) {
                    $dados['nome_erro'] = "Preencha o Nome";
                }
                if (empty($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Preencha o email";
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
                } elseif ($this->usuarioModel->checarEmailUsuario($dados)) {
                    $dados['email_erro'] = "Email já está sendo utilizado";
                } elseif (strlen($formulario['txtSenha']) < 6) {
                    $dados['senha_erro'] = "A senha precisa ter no mínimo 6 caracteres";
                } elseif ($formulario['txtSenha'] != $formulario['txtConfirmaSenha']) {
                    $dados['confirma_senha_erro'] = "As senhas são diferentes";
                } else {

                    //Criptografa a senha com hash em php
                    $dados['txtSenha'] = password_hash($formulario['txtSenha'], PASSWORD_DEFAULT);

                    if ($this->usuarioModel->armazenarUsuario($dados)) {
                        echo "Cadastrado com sucesso";
                    } else {
                        die("Erro ao armazenar usuário no banco de dados");
                    }
                }
            }
        } else {
            $dados = [
                'txtNome' => '',
                'txtEmail' => '',
                'txtSenha' => '',
                'txtConfirmaSenha' => '',
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => ''
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
                'txtSenha' => trim($formulario['txtSenha'])
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

                    $usuario = $this->usuarioModel->checarLogin($formulario['txtEmail'], $formulario['txtSenha']);

                    if ($usuario) {
                        $this->criarSessaoUsuario($usuario);
                    } else {
                        echo "Usuário ou senha inválidos";
                    }
                }
            }
        } else {
            $dados = [
                'txtNome' => '',
                'txtEmail' => '',
                'email_erro' => '',
                'senha_erro' => ''
            ];
        }

        //Retorna para a view
        $this->view('usuarios/login', $dados);
    }

    private function criarSessaoUsuario($usuario){
        $_SESSION['id_usuario'] = $usuario->id_usuario;
        $_SESSION['ds_nome']= $usuario->ds_nome;
        $_SESSION['email'] = $usuario->email;
    }
}
