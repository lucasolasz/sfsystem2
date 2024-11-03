<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div class="card">
        <div class="card-body">
            <h2>Cadastro de Visitante</h2>
            <small>Preencha o formulário abaixo para cadastrar um novo visitante</small>

            <form name="cadastrar" method="POST" action="<?= URL . 'Visitantes/cadastrar' ?>">
                <div class="mb-3">
                    <label for="txtNome" class="form-label">Nome: *</label>
                    <input type="text" class="form-control <?= $dados['nome_erro'] ? 'is-invalid' : '' ?>"
                        name="txtNome" id="txtNome" value="<?= $dados['txtNome'] ?>" maxlength="255">
                    <div class="invalid-feedback"><?= $dados['nome_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtDocumento" class="form-label">Documento: * <span style="color: gray;">(apenas
                            números)</span></label>
                    <input type="text" class="form-control <?= $dados['documento_erro'] ? 'is-invalid' : '' ?>"
                        name="txtDocumento" id="txtDocumento" value="<?= $dados['txtDocumento'] ?>" maxlength="11">
                    <div class="invalid-feedback"><?= $dados['documento_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtTelefoneUm" class="form-label">Telefone 1: * <span style="color: gray;">(apenas
                            números)</span></label>
                    <input type="text" class="form-control" name="txtTelefoneUm" id="txtTelefoneUm"
                        value="<?= $dados['txtTelefoneUm'] ?>" maxlength="11">

                </div>
                <div class="mb-3">
                    <label for="txtTelefoneDois" class="form-label">Telefone 2: * <span style="color: gray;">(apenas
                            números)</span></label>
                    <input type="text" class="form-control" name="txtTelefoneDois" id="txtTelefoneDois"
                        value="<?= $dados['txtTelefoneDois'] ?>" maxlength="11">

                </div>
                <div class="d-flex">
                    <div class="p-2">
                        <input type="submit" value="Cadastrar" class="btn btn-primary">
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