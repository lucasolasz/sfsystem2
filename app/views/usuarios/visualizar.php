<div class="container py-5">

    <?= Alertas::mensagem('usuario') ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL . 'Paginas/index' ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuários</li>
        </ol>
    </nav>

    <div class="card">

        <div class="card-header">

            <h5 class="tituloIndex">Usuários
                <div style="float: right;">
                    <a href="<?= URL . 'Usuarios/cadastrar' ?>" class="btn btn-primary">Novo usuário</a>
                </div>
            </h5>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableDataTablePtBr" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome usuário</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados['usuarios'] as $usuarios) { ?>
                            <tr>
                                <td><?= ucfirst($usuarios->ds_nome_usuario) ?></td>
                                <td>
                                    <a href="<?= URL . 'Usuarios/editarUsuario/' . $usuarios->id_usuario ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>

                                    <a href="<?= URL . 'Usuarios/deletarUsuario/' . $usuarios->id_usuario ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Exlcuir</a>
                                </td>
                            <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>