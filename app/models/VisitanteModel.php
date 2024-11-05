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

    public function contarVisitantesComFiltro(
        $busca = '',
        $colunaOrdenacao = 0,
        $tabela = null,
        $direcaoOrdenacao = 'asc',
        $listaColunasPesquisa = null,
        $listaColunaOrdenacao = null
    ) {

        $consulta = "SELECT * FROM $tabela WHERE 1=1";

        if (!empty($busca)) {
            $consulta .= $this->montarQueryBusca($listaColunasPesquisa);
        }

        // Adicionar a cláusula ORDER BY
        if (!empty($listaColunaOrdenacao)) {
            $consulta .= " ORDER BY ";
            foreach ($listaColunaOrdenacao as $coluna) {
                $consulta .= " $coluna,";
            }
            // Remover a última vírgula e adicionar a direção de ordenação
            $consulta = rtrim($consulta, ',') . " $direcaoOrdenacao";
        }

        $this->db->query($consulta);

        if (!empty($busca)) {
            $this->db->bind("busca", '%' . $busca . '%');
        }

        return $this->db->resultados();
    }

    public function obterVisitantesPaginados(
        $inicio = null,
        $quantidade = null,
        $busca = '',
        $colunaOrdenacao = 0,
        $direcaoOrdenacao = 'asc',
        $tabela = null,
        $listaColunasPesquisa = null,
        $listaColunaOrdenacao = null
    ) {
        $colunaOrdenada = isset($listaColunasPesquisa[$colunaOrdenacao]) ? $listaColunasPesquisa[$colunaOrdenacao] : 'nm_visitante';

        $consulta = "SELECT * FROM $tabela WHERE 1=1";

        if (!empty($busca)) {
            $consulta .= $this->montarQueryBusca($listaColunasPesquisa);
        }

        // $consulta .= " ORDER BY $colunaOrdenada $direcaoOrdenacao LIMIT :inicio, :quantidade";
        $consulta .= $this->montarQueryOderBy($listaColunaOrdenacao, $direcaoOrdenacao);

        $this->db->query($consulta);
        $this->db->bind("inicio", (int) $inicio, PDO::PARAM_INT);
        $this->db->bind("quantidade", (int) $quantidade, PDO::PARAM_INT);
        if (!empty($busca)) {
            // $consulta .= " AND (nm_visitante LIKE :busca)";
            $this->db->bind("busca", '%' . $busca . '%');
        }

        return $this->db->resultados();
    }

    private function montarQueryOderBy($listaColunaOrdenacao, $direcaoOrdenacao)
    {
        $stringSaida = " ORDER BY ";
        foreach ($listaColunaOrdenacao as $coluna) {
            $stringSaida .= "$coluna ,";
        }
        $stringSaida = substr($stringSaida, 0, -1);
        $stringSaida .= " $direcaoOrdenacao LIMIT :inicio, :quantidade ";

        return $stringSaida;
    }

    private function montarQueryBusca($listaColunas)
    {
        $stringSaida = " AND (";
        $condicoes = [];
        foreach ($listaColunas as $coluna) {
            $condicoes[] = "$coluna LIKE :busca";
        }
        $stringSaida .= implode(" OR ", $condicoes);
        $stringSaida .= ")";

        return $stringSaida;
    }



}
