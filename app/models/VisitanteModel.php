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
        $this->db->query("SELECT * FROM tb_visitante ORDER BY nm_visitante");
        return $this->db->resultados();
    }

    public function atualizarVisitante($dados)
    {

        $this->db->query("UPDATE tb_visitante SET 
        nm_visitante = :nm_visitante,
        documento_visitante =  :documento_visitante, 
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

    public function contarVisitantes()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM tb_visitante");
        return $this->db->resultado()->total;
    }

    public function obterVisitantesPaginados($inicio, $quantidade, $busca = '', $colunaOrdenacao = 0, $direcaoOrdenacao = 'asc')
    {
        $colunas = ['nm_visitante', 'documento_visitante']; // Colunas disponíveis para ordenação
        $colunaOrdenada = isset($colunas[$colunaOrdenacao]) ? $colunas[$colunaOrdenacao] : 'nm_visitante';

        $consulta = "SELECT * FROM tb_visitante WHERE 1=1";

        if (!empty($busca)) {
            $consulta .= " AND (nm_visitante LIKE :busca)";
            // $this->db->bind("busca", '%' . $busca . '%');
        }

        $consulta .= " ORDER BY $colunaOrdenada $direcaoOrdenacao LIMIT :inicio, :quantidade";
        $this->db->query($consulta);
        $this->db->bind("inicio", (int) $inicio, PDO::PARAM_INT);
        $this->db->bind("quantidade", (int) $quantidade, PDO::PARAM_INT);
        if (!empty($busca)) {
            // $consulta .= " AND (nm_visitante LIKE :busca)";
            $this->db->bind("busca", '%' . $busca . '%');
        }

        return $this->db->resultados();
    }

    

}
