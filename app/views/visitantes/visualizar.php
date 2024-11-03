<div class="container py-5">

    <?= Alertas::mensagem('visitante') ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL . 'Paginas/index' ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visitantes</li>
        </ol>
    </nav>

    <div class="card">

        <div class="card-header">

            <h5 class="tituloIndex">Visitantes
                <div style="float: right;">
                    <a href="<?= URL . 'Visitantes/cadastrar' ?>" class="btn btn-primary">Novo</a>
                </div>
            </h5>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableDataTablePtBr" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados['visitantes'] as $usuarios) { ?>
                            <tr>
                                <td><?= ucfirst($usuarios->nm_visitante) ?></td>
                                <td>
                                    <a href="<?= URL . 'Visitantes/editarVisitante/' . $usuarios->id_visitante ?>"
                                        class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>

                                    <a href="<?= URL . 'Visitantes/entradaVisita/' . $usuarios->id_visitante ?>"
                                        class="btn btn-success"><i class="bi bi-arrow-up-circle-fill"></i> Entrada
                                        Visita</a>
                                </td>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>