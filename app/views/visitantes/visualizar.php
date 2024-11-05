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
                <table id="tabela" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Documento</th>
                        </tr>
                    </thead>
                    <tbody>

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
                        tabela: 'tb_visitante',
                        colunas_pesquisa: ['nm_visitante', 'documento_visitante'],
                        colunas_ordenacao: ['nm_visitante'],
                        start: d.start,
                        length: d.length,
                        search: d.search.value,
                        order: d.order,
                        draw: d.draw
                    };
                    return JSON.stringify(params); // Converte para JSON
                },
                "contentType": "application/json; charset=utf-8", // Define o tipo de conteúdo
                "dataType": "json" // Espera receber JSON
            },
            "columns": [
                { "data": "nm_visitante" },
                { "data": "documento_visitante" }
            ]
        });
    });
</script>