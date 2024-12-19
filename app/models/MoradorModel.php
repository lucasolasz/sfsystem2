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
            tel_emergencia,
            flag_locatario,
            nm_locatario,
            documento_locatario,
            dt_nascimento_locatario,
            email_locatario,
            tel_um_locatario,
            tel_dois_locatario,
            flag_tem_pet,
            qtd_pets,
            flag_adesivo,
            qtd_adesivos
            )
            VALUES(:nm_morador,
             :fk_casa, 
             :documento_morador, 
             :dt_nascimento_morador, 
             :tel_um_morador, 
             :tel_dois_morador, 
             :email_morador, 
             :tel_emergencia,
             :flag_locatario,
             :nm_locatario,
             :documento_locatario,
             :dt_nascimento_locatario,
             :email_locatario,
             :tel_um_locatario,
             :tel_dois_locatario,   
             :flag_tem_pet,
             :qtd_pets,
             :flag_adesivo,
             :qtd_adesivos
             );";

        $this->db->query($query);

        $this->db->bind("nm_morador", $dados['txtNomeProprietario']);
        $this->db->bind("fk_casa", $dados['cboCasa']);
        $this->db->bind("documento_morador", $dados['txtDocumentoProprietario']);
        $this->db->bind("dt_nascimento_morador", $dados['dateNascimentoProprietario']);
        $this->db->bind("tel_um_morador", $dados['txtTelefoneUmProprietario']);
        $this->db->bind("tel_dois_morador", $dados['txtTelefoneDoisProprietario']);
        $this->db->bind("email_morador", $dados['txtEmailProprietario']);
        $this->db->bind("tel_emergencia", $dados['txtTelefoneEmergenciaProprietario']);

        $this->db->bind("flag_locatario", $dados['chkLocatario']);
        $this->db->bind("nm_locatario", $dados['txtNomeLocatario']);
        $this->db->bind("documento_locatario", $dados['txtDocumentoLocatario']);
        $this->db->bind("dt_nascimento_locatario", $dados['dateNascimentoLocatario']);
        $this->db->bind("email_locatario", $dados['txtEmailLocatario']);
        $this->db->bind("tel_um_locatario", $dados['txtTelefoneUmLocatario']);
        $this->db->bind("tel_dois_locatario", $dados['txtTelefoneDoisLocatario']);
        $this->db->bind("flag_tem_pet", $dados['chkPossuiPets']);
        $this->db->bind("qtd_pets", $dados['qtdPets']);
        $this->db->bind("flag_adesivo", $dados['chkRecebeuAdesivo']);
        $this->db->bind("qtd_adesivos", $dados['qtdAdesivos']);


        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function ultimoIdInserido()
    {
        return $this->db->ultimoIdInserido();
    }
}