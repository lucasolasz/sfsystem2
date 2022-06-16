<div class="col-xl-4 col-md-6 mx-auto p-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL ?>/agendaController">Agenda Convidados</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $dados['agenda']->ds_nome_convidado ?></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h2>Editar Evento</h2>
            <small>Preencha o formulário abaixo para editar o evento</small>

            <form name="editar" method="POST" action="<?php echo URL . '/agendaController/editar/' . $dados['agenda']->id_agenda_convidados ?>">
                <br>
                <div class="mb-3">
                    <label for="txtNomeConvidado" class="form-label">Nome do Convidado: *</label>
                    <input type="text" class="form-control <?php echo $dados['nome_erro'] ? 'is-invalid' : '' ?>" name="txtNomeConvidado" id="txtNomeConvidado" value="<?php echo $dados['agenda']->ds_nome_convidado ?>">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?php echo $dados['nome_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="txtDataEntrevistaEscrita" class="form-label">Data Entrevista Escrita: *</label>
                    <input type="date" class="form-control <?php echo $dados['dataEntrevista_erro'] ? 'is-invalid' : '' ?>" name="txtDataEntrevistaEscrita" id="txtDataEntrevistaEscrita" value="<?php echo $dados['agenda']->dt_entrevista_escrita ?>">
                    <div class="invalid-feedback"><?php echo $dados['dataEntrevista_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="txtLinkEntrevistaEscrita" class="form-label">Link Entrevista Escrita:</label>
                    <input type="text" class="form-control" name="txtLinkEntrevistaEscrita" id="txtLinkEntrevistaEscrita" value="<?php echo $dados['agenda']->link_entrevista_escrita ?>">
                </div>

                <div class="mb-3">
                    <label for="txtDataTreinamento" class="form-label">Data e Hora do Treinamento: </label>
                    <input type="date" class="form-control" name="txtDataTreinamento" id="txtDataTreinamento" value="<?php echo $dados['agenda']->dt_treinamento ?>">
                    <br>
                    <input type="time" class="form-control" name="txtHoraTreinamento" id="txtHoraTreinamento" value="<?php echo Checa::horaFormat($dados['agenda']->dt_hora_treinamento) ?>">
                </div>

                <div class="mb-3">
                    <label for="txtDataLivee" class="form-label">Data e Hora da Live:</label>
                    <input type="date" class="form-control" name="txtDataLive" id="txtDataLive" value="<?php echo $dados['agenda']->dt_live ?>">
                    <br>
                    <input type="time" class="form-control" name="txtHoraLive" id="txtHoraLive" value="<?php echo Checa::horaFormat($dados['agenda']->dt_hora_live) ?>">
                </div>

                <div class="mb-3">
                    <label for="txtLinkLivee" class="form-label">Link da Live:</label>
                    <input type="text" class="form-control" name="txtLinkLive" id="txtLinkLive" value="<?php echo $dados['agenda']->link_live ?>">
                </div>

                <div class="row">
                    <div class="col-md-1">
                        <input type="submit" value="Atualizar Evento" class="btn btn-artcor">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted">
            <p>Criado por: <b><?php echo ucfirst($dados['fk_usuario']->ds_nome_usuario) ?></b> em <i><?php echo Checa::dataBr($dados['agenda']->criado_em) ?></i></p>

            <?php if (!empty($dados['agenda']->fk_usuario_edicao)) { ?>
                <p>Editado por: <b><?php echo $dados['usuarioEdicao']->ds_nome_usuario ?></b> em <i><?php echo Checa::dataHoraFormatBr($dados['agenda']->editado_em) ?></i></p>
            <?php } ?>
        </div>
    </div>
</div>