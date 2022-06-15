<?php

class Usuario
{

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function checarLogin($email, $senha)
    {
        $this->db->query("SELECT * FROM usuarios WHERE email = :email");

        $this->db->bind("email", $email);

        if ($this->db->resultado()) {

            $resultado = $this->db->resultado();


            //Verifica o hash code
            if (password_verify($senha, $resultado->ds_senha)) {
                return $resultado;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function checarEmailUsuario($dados)
    {
        $this->db->query("SELECT email FROM usuarios WHERE email = :email");

        $this->db->bind("email", $dados['txtEmail']);

        if ($this->db->resultado()) {
            return true;
        } else {
            return false;
        }
    }

    public function armazenarUsuario($dados)
    {

        $this->db->query("INSERT INTO usuarios (ds_nome, email, ds_senha) VALUES (:ds_nome, :email, :ds_senha)");

        $this->db->bind("ds_nome", $dados['txtNome']);
        $this->db->bind("email", $dados['txtEmail']);
        $this->db->bind("ds_senha", $dados['txtSenha']);


        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function loginUsuario($dados)
    {

        $this->db->query("SELECT email FROM usuarios WHERE email = :email");

        $this->db->bind("email", $dados['txtEmail']);

        if ($this->db->resultado()) {

            $this->db->query("SELECT ds_senha FROM usuarios WHERE ds_senha = :ds_senha");

            $this->db->bind("ds_senha", $dados['txtSenha']);

            if ($this->db->resultado()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
