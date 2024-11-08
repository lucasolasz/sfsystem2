<?php

class VeiculoModel
{

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function recuperarTiposVeiculos()
    {
        $this->db->query("SELECT * FROM tb_tipo_veiculo ORDER BY ds_tipo_veiculo");
        return $this->db->resultados();
    }

    public function recuperarCoresVeiculos()
    {
        $this->db->query("SELECT * FROM tb_cor_veiculo ORDER BY ds_cor_veiculo");
        return $this->db->resultados();
    }

    public function armazenarCarrosVisitante($lista, $idVisitante)
    {
        $this->executarQueryInsertVeiculos($lista, $idVisitante);
    }

    public function editarCarrosVisitante($lista, $idVisitante)
    {
        $this->executarQueryDeleteVeiculosPorIdVisitante($idVisitante);
        $this->executarQueryInsertVeiculos($lista, $idVisitante);
    }

    private function executarQueryDeleteVeiculosPorIdVisitante($idVisitante)
    {
        $this->db->query(" DELETE FROM tb_veiculo WHERE fk_visitante = :idVisitante ");
        $this->db->bind("idVisitante", intval($idVisitante));
        $this->db->executa();

    }

    private function executarQueryInsertVeiculos($lista, $idVisitante)
    {
        foreach ($lista as $veiculo) {
            $this->db->query("INSERT INTO tb_veiculo (ds_placa_veiculo, fk_visitante, fk_cor_veiculo, fk_tipo_veiculo) VALUES (:ds_placa_veiculo, :fk_visitante, :fk_cor_veiculo, :fk_tipo_veiculo)");

            $this->db->bind("ds_placa_veiculo", trim($veiculo['ds_placa_veiculo']));
            $this->db->bind("fk_visitante", intval($idVisitante));
            $this->db->bind("fk_cor_veiculo", intval($veiculo['fk_cor_veiculo']));
            $this->db->bind("fk_tipo_veiculo", intval($veiculo['fk_tipo_veiculo']));

            $this->db->executa();
        }

    }
}
