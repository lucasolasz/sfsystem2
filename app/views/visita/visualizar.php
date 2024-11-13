<?php

var_dump($dados);

?>

<div class="container py-5">

    <?= Alertas::mensagem('visita') ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL . 'Paginas/index' ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visitas em andamento</li>
        </ol>
    </nav>

    <div class="card">

        <div class="card-header">

            <h5 class="tituloIndex">Visitas em andamento
                <div style="float: right;">
                    <a href="<?= URL . 'Visitantes/visualizarVisitantes' ?>" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Registrar nova visita</a>
                </div>
            </h5>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabela" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome visitante</th>
                            <th scope="col">Tipo Visita</th>
                            <th scope="col">Data Entrada</th>
                            <th scope="col">Hora Entrada</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados['visitas'] as $visita) { ?>
                            <tr>
                                <td><?= ucfirst($visita->nm_visitante) ?></td>
                                <td><?= ucfirst($visita->ds_tipo_visita) ?></td>
                                <td><?= date('d/m/Y', strtotime($visita->dt_entrada_visita)) ?></td>
                                <td><?= $visita->dt_hora_entrada_visita ?></td>
                                <td>
                                    <a href="<?= URL . 'Visitas/visualizarInformacoes/' . $visita->id_visita ?>"
                                        class="btn btn-warning"><i class="bi bi-info-circle"></i> Informações</a>

                                    <a href="<?= URL . 'Visitas/registrarSaida' . $visita->id_visita ?>"
                                        class="btn btn-danger"><i class="bi bi-arrow-up-square"></i> Registrar Saída</a>
                                </td>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>