<div class="container py-5">

    <?php echo Alertas::mensagem('agenda') ?>

    <div class="card">

        <div class="artcor card-header">

            <h5>AC Encontros Literários - Agenda de Convidados
                <div style="float: right;">
                    <a href="<?php echo URL ?>/agendaController/cadastrar" class="btn btn-artcor">Novo evento</a>
                </div>
            </h5>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome Convidado</th>
                            <th scope="col">Data Entrevista Escrita</th>
                            <th scope="col">Link Entrevista Escrita</th>
                            <th scope="col">Data Treinamento</th>
                            <th scope="col">Hora Treinamento</th>
                            <th scope="col">Data Live</th>
                            <th scope="col">Hora Live</th>
                            <th scope="col">Link Live</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Exibe mensagem caso não tenha nenhum evento
                        if (empty($dados['eventos'])) { ?>

                            <tr>
                                <td colspan="9" class="align-middle">Nenhum Evento cadastrado</td>
                            </tr>


                        <?php  }


                        foreach ($dados['eventos'] as $eventos) { ?>

                            <tr>
                                <td><?php echo $eventos->ds_nome_convidado ?></td>
                                <td><?php echo Checa::dataBr($eventos->dt_entrevista_escrita) ?></td>

                                <!-- Verifica se link está vazio e não exibir botão de link vazio -->
                                <?php if (empty($eventos->link_entrevista_escrita)) { ?>
                                    <td></td>
                                <?php } else { ?>
                                    <td><a href="<?php echo $eventos->link_entrevista_escrita ?>" target="_blank" rel="noopener noreferrer" class="btn btn-danger"><i class="bi bi-play-btn-fill"></i></a></td>
                                <?php } ?>

                                <td><?php echo Checa::dataBr($eventos->dt_treinamento) ?></td>
                                <td><?php echo Checa::horaFormat($eventos->dt_hora_treinamento) ?></td>
                                <td><?php echo Checa::dataBr($eventos->dt_live) ?></td>
                                <td><?php echo Checa::horaFormat($eventos->dt_hora_live) ?> </p>

                                <!-- Verifica se link está vazio e não exibir botão de link vazio -->
                                <?php if (empty($eventos->link_live)) { ?>
                                    <td></td>
                                <?php } else { ?>
                                <td><a href="<?php echo $eventos->link_live ?>" target="_blank" rel="noopener noreferrer" class="btn btn-danger"><i class="bi bi-play-btn-fill"></i></a></td>
                            <?php } ?>

                            <td><a href="<?php echo URL . '/agendaController/editar/' . $eventos->id_agenda_convidados ?>" class="btn btn-artcor"><i class="bi bi-pencil-square"></i></a></td>
                            <td>
                                <form action="<?php echo URL . '/agendaController/deletar/' . $eventos->id_agenda_convidados ?>" method="POST">
                                    <button type="submit" class="btn btn-danger"><span><i class="bi bi-trash-fill"></i></span></button>
                                </form>
                            </td>



                            <!-- <p>Criado por: <b><?php echo ucfirst($eventos->ds_nome_usuario) ?></b> em <i><?php echo Checa::dataBr($eventos->criado_em) ?></i></p> -->
                            </tr>

                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>