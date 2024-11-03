<?php

class VisitanteModel
{

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function retornarVisitantePorId($id)
    {
        $this->db->query("SELECT * FROM tb_visitante WHERE id_visitante = :id_visitante");

        $this->db->bind("id_visitante", $id);

        return $this->db->resultado();
    }


    public function armazenarVisitante($dados)
    {
        $this->db->query("INSERT INTO tb_visitante (nm_visitante, documento_visitante, telefone_um_visitante, telefone_dois_visitante) 
            VALUES (:nm_visitante, :documento_visitante, :telefone_um_visitante, :telefone_dois_visitante)");

        $this->db->bind("nm_visitante", $dados['txtNome']);
        $this->db->bind("documento_visitante", $dados['txtDocumento']);
        $this->db->bind("telefone_um_visitante", $dados['txtTelefoneUm']);
        $this->db->bind("telefone_dois_visitante", $dados['txtTelefoneDois']);

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function visualizarVisitantes()
    {
        $this->db->query("SELECT * FROM tb_visitante ORDER BY nm_visitante LIMIT 100");
        return $this->db->resultados();
    }

    public function atualizarVisitante($dados)
    {

        $this->db->query("UPDATE tb_visitante SET 
        nm_visitante = :nm_visitante,
        documento_visitante=  :documento_visitante, 
        telefone_um_visitante = :telefone_um_visitante,
        telefone_dois_visitante = :telefone_dois_visitante
        WHERE id_visitante = :id_visitante;");

        $this->db->bind("nm_visitante", trim($dados['txtNome']));
        $this->db->bind("documento_visitante", trim($dados['txtDocumento']));
        $this->db->bind("telefone_um_visitante", $dados['txtTelefoneUm']);
        $this->db->bind("telefone_dois_visitante", $dados['txtTelefoneDois']);
        $this->db->bind("id_visitante", $dados['idVisitante']);

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

}
