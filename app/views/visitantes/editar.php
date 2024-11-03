<div class="col-xl-4 col-md-6 mx-auto p-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL . 'Visitantes/visualizarVisitantes' ?>">Visitantes</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= ucfirst($dados['visitante']->nm_visitante) ?>
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h2>Editar Visitante</h2>
            <small>Preencha o formulário abaixo para editar o visitante</small>

            <form name="editar" method="POST"
                action="<?= URL . 'Visitantes/editarVisitante/' . $dados['visitante']->id_visitante ?>">
                <div class="mb-3 mt-4">
                    <label for="txtNome" class="form-label">Nome: *</label>
                    <input type="text" class="form-control <?= $dados['nome_erro'] ? 'is-invalid' : '' ?>"
                        name="txtNome" id="txtNome" value="<?= $dados['visitante']->nm_visitante ?>">
                    <div class="invalid-feedback"><?= $dados['nome_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtDocumento" class="form-label">Documento: * <span style="color: gray;">(apenas
                            números)</span></label>
                    <input type="text" class="form-control <?= $dados['documento_erro'] ? 'is-invalid' : '' ?>"
                        name="txtDocumento" id="txtDocumento" value="<?= $dados['visitante']->documento_visitante ?>"
                        maxlength="11">
                    <div class="invalid-feedback"><?= $dados['documento_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtTelefoneUm" class="form-label">Telefone 1: * <span style="color: gray;">(apenas
                            números)</span></label>
                    <input type="text" class="form-control" name="txtTelefoneUm" id="txtTelefoneUm"
                        value="<?= $dados['visitante']->telefone_um_visitante ?>" maxlength="11">

                </div>
                <div class="mb-3">
                    <label for="txtTelefoneDois" class="form-label">Telefone 2: * <span style="color: gray;">(apenas
                            números)</span></label>
                    <input type="text" class="form-control" name="txtTelefoneDois" id="txtTelefoneDois"
                        value="<?= $dados['visitante']->telefone_dois_visitante ?>" maxlength="11">

                </div>
                <div class="d-flex">
                    <div class="p-2">
                        <input type="submit" value="Salvar" class="btn btn-primary">
                    </div>
                    <div class="p-2">
                        <a class="btn btn-secondary" href="<?= URL . 'Visitantes/visualizarVisitantes' ?>"
                            role="button">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>