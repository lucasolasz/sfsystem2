<div class="container py-5">

    <?php echo Alertas::mensagem('agenda') ?>

    <div class="card">

        <div class="artcor card-header">

            <h5>AGENDA DE CONVIDADOS
                <div style="float: right;">
                    <a href="<?php echo URL ?>/agendaController/cadastrar" class="btn btn-artcor">Novo evento</a>
                </div>
            </h5>

        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($dados['eventos'] as $eventos) { ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-header artcor">
                                Convidado: <b style="color: white;"><?php echo $eventos->ds_nome_convidado ?></b>

                                <div style="float: right;">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="<?php echo URL . '/agendaController/editar/' . $eventos->id_agenda_convidados ?>" class="btn btn-artcor"><i class="bi bi-pencil-square"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <form action="<?php echo URL . '/agendaController/deletar/' . $eventos->id_agenda_convidados ?>" method="POST">
                                                
                                            <button type="submit" class="btn btn-danger"><span><i class="bi bi-trash-fill"></i></span></button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">

                                <p>Data Entrevista Escrita: <?php echo Checa::dataBr($eventos->dt_entrevista_escrita) ?></p>
                                <p>Link Entrevista Escrita: <a href="<?php echo $eventos->link_entrevista_escrita ?>" target="_blank" rel="noopener noreferrer">Link</a></p>
                                <hr>
                                <p>Data Treinamento: <?php echo Checa::dataBr($eventos->dt_treinamento) ?></p>
                                <p>Hora Treinamento: <?php echo Checa::horaFormat($eventos->dt_hora_treinamento) ?></p>
                                <hr>
                                <p>Data Live: <?php echo Checa::dataBr($eventos->dt_live) ?></p>
                                <p>Hora Live: <?php echo Checa::horaFormat($eventos->dt_hora_live) ?> </p>
                                <p>Link Live: <a href="<?php echo $eventos->link_live ?>" target="_blank" rel="noopener noreferrer">Link</a></p>


                            </div>
                            <div class="card-footer text-muted">
                                <p>Criado por: <b><?php echo ucfirst($eventos->ds_nome_usuario) ?></b> em <i><?php echo Checa::dataBr($eventos->criado_em) ?></i></p>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
            </div>
        </div>


    </div>
</div>