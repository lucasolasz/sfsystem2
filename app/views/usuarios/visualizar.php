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
                <table id="tabela" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome usuário</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados['usuarios'] as $usuarios) { ?>
                            <tr>
                                <td><?= ucfirst($usuarios->ds_nome_usuario) ?></td>
                                <td>
                                    <a href="<?= URL . 'Usuarios/editarUsuario/' . $usuarios->id_usuario ?>"
                                        class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>

                                    <a href="<?= URL . 'Usuarios/deletarUsuario/' . $usuarios->id_usuario ?>"
                                        class="btn btn-danger"><i class="bi bi-trash-fill"></i> Exlcuir</a>
                                </td>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>



    $(document).ready(function () {
        $('#tabela').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "/ListarDataTable/listarRegistrosDataTable",
                "type": "POST",
                "data": function (d) {
                    // Monta o objeto a ser enviado
                    var params = {
                        tabela: 'tb_usuario',
                        colunas_pesquisa: ['ds_nome_usuario'],
                        colunas_ordenacao: ['ds_nome_usuario'],
                        start: d.start,
                        length: d.length,
                        search: d.search.value,
                        order: d.order,
                        draw: d.draw,
                        joins: [
                            {
                                tabela: 'tb_cargo',
                                condicao: 'tb_usuario.fk_cargo = tb_cargo.id_cargo'
                            }
                        ]
                    };
                    return JSON.stringify(params); // Converte para JSON
                },
                "contentType": "application/json; charset=utf-8", // Define o tipo de conteúdo
                "dataType": "json" // Espera receber JSON
            },
            "columns": [
                { "data": "ds_nome_usuario" },
                { "data": "ds_cargo" },
                {
                    "data": null, // Define como null pois será preenchido manualmente
                    "orderable": false, // Impede ordenação para esta coluna
                    "render": function (data, type, row) {
                        // Retorna o HTML para os botões de ação
                        return `
                            <a href="/Usuarios/editarUsuario/${row.id_usuario}" class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="/Usuarios/deletarUsuario/${row.id_usuario}" class="btn btn-danger">
                                <i class="bi bi-trash-fill"></i> Excluir
                            </a>`;
                    }
                }
            ]
        });
    });
</script>