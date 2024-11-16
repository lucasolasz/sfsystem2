<?php

class MoradorModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function recuperarTodosOsMoradoresCadastrados()
    {
        $this->db->query("SELECT * FROM tb_morador ORDER BY nm_morador");
        return $this->db->resultados();
    }

    public function armazenarMorador($dados)
    {
        $query = "INSERT INTO tb_morador
            (nm_morador, 
            fk_casa, 
            documento_morador, 
            dt_nascimento_morador, 
            tel_um_morador, 
            tel_dois_morador, 
            email_morador, 
            tel_emergencia
            )
            VALUES(:nm_morador,
             :fk_casa, 
             :documento_morador, 
             :dt_nascimento_morador, 
             :tel_um_morador, 
             :tel_dois_morador, 
             :email_morador, 
             :tel_emergencia
             );";

        $this->db->query($query);

        $this->db->bind("nm_morador", $dados['txtNome']);
        $this->db->bind("fk_casa", $dados['cboCasa']);
        $this->db->bind("documento_morador", $dados['txtDocumentoMoradorAtual']);
        $this->db->bind("dt_nascimento_morador", $dados['dateNascimentoMorador']);
        $this->db->bind("tel_um_morador", $dados['txtTelefoneUm']);
        $this->db->bind("tel_dois_morador", $dados['txtTelefoneDois']);
        $this->db->bind("email_morador", $dados['txtEmail']);
        $this->db->bind("tel_emergencia", $dados['txtTelefoneEmergencia']);


        $this->db->executa();
    }
}
