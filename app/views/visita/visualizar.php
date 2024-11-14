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
                            <th scope="col">Casa destino</th>
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
                                <td><?= ucfirst($visita->ds_numero_casa) ?></td>
                                <td><?= date('d/m/Y', strtotime($visita->dt_entrada_visita)) ?></td>
                                <td><?= date('H:i', strtotime($visita->dt_hora_entrada_visita)) . 'h' ?></td>
                                <td>
                                    <a href="<?= URL . 'Visitas/visualizarInformacoes/' . $visita->id_visita ?>"
                                        class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalInformacoes"><i class="bi bi-info-circle"></i> Informações</a>

                                    <a href="<?= URL . 'Visitas/registrarSaida' . $visita->id_visita ?>"
                                        class="btn btn-danger"><i class="bi bi-arrow-up-square"></i> Registrar Saída</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="modalInformacoes" tabindex="-1" aria-labelledby="modalInformacoesLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalInformacoesLabel">Informações da Visita: <?= ucfirst($visita->nm_visitante) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Observações:</h6>
                                            <p><?= $visita->observacao_visita != "" ? ucfirst($visita->observacao_visita) : '<i>Nenhuma observação</i>' ?></p>
                                            <h6>Tempo de visita:</h6>
                                            <p id="contador<?= $visita->id_visita ?>"></p> <!-- Elemento onde o tempo será exibido -->

                                            <h6>Tipo Veículo - Placa veículo:</h6>
                                            <p><?= $visita->ds_tipo_veiculo != "" ? $visita->ds_tipo_veiculo . " - " . strtoupper($visita->ds_placa_veiculo) : '<i>Visitante sem placa escolhida</i>' ?></p>

                                            <h6>Casa destino:</h6>
                                            <p><?= $visita->ds_numero_casa ?></p>

                                            <h6>Entrada dada pelo porteiro(a):</h6>
                                            <p><?= $visita->ds_nome_usuario ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    const entradaTimestamp<?= $visita->id_visita ?> = new Date("<?= $visita->dt_entrada_visita . ' ' . $visita->dt_hora_entrada_visita ?>").getTime();

    function atualizarContador<?= $visita->id_visita ?>() {
        const agora = new Date().getTime();
        const tempoDecorrido = agora - entradaTimestamp<?= $visita->id_visita ?>;

        const horas = Math.floor((tempoDecorrido / (1000 * 60 * 60)) % 24);
        const minutos = Math.floor((tempoDecorrido / (1000 * 60)) % 60);
        const segundos = Math.floor((tempoDecorrido / 1000) % 60);

        document.getElementById("contador<?= $visita->id_visita ?>").innerHTML =
            `${horas.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;
    }

    setInterval(atualizarContador<?= $visita->id_visita ?>, 1000);
</script>