<div class="row">
    <div class="col-sm-10 mx-auto p-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= URL . 'Moradores/visualizarMoradores' ?>">Moradores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Novo morador</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <h2>Cadastro de Moradores</h2>
                <p class="mb-3 text-muted">Preencha o formulário abaixo para cadastrar um novo morador</p>

                <form name="cadastrar" method="POST" action="<?= URL . 'Moradores/cadastrar' ?>">
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="txtNome" class="form-label">Nome Completo Morador Atual: *</label>
                            <input type="text" class="form-control <?= $dados['nome_erro'] ? 'is-invalid' : '' ?>" name="txtNome" id="txtNome" value="<?= $dados['txtNome'] ?>" maxlength="255">
                            <!-- Div para exibir o erro abaixo do campo -->
                            <div class="invalid-feedback"><?= $dados['nome_erro'] ?></div>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="txtDocumentoMoradorAtual" class="form-label">Documento Morador Atual: *</label>
                            <input type="text" class="form-control <?= $dados['documento_erro'] ? 'is-invalid' : '' ?>" name="txtDocumentoMoradorAtual" id="txtDocumentoMoradorAtual" value="<?= $dados['txtDocumentoMoradorAtual'] ?>" maxlength="11">
                            <!-- Div para exibir o erro abaixo do campo -->
                            <div class="invalid-feedback"><?= $dados['documento_erro'] ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="dateNascimentoMorador" class="form-label">Data Nascimento Morador: *</label>
                            <input type="date" class="form-control <?= $dados['dataNascimentoMorador_erro'] ? 'is-invalid' : '' ?>" name="dateNascimentoMorador" id="dateNascimentoMorador" value="<?= $dados['dateNascimentoMorador'] ?>">
                            <!-- Div para exibir o erro abaixo do campo -->
                            <div class="invalid-feedback"><?= $dados['dataNascimentoMorador_erro'] ?></div>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="txtEmail" class="form-label">E-mail: *</label>
                            <input type="text" class="form-control <?= $dados['email_erro'] ? 'is-invalid' : '' ?>" name="txtEmail" id="txtEmail" value="<?= $dados['txtEmail'] ?>" maxlength="100">
                            <div class="invalid-feedback"><?= $dados['email_erro'] ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="txtTelefoneUm" class="form-label">Telefone 1: *</label>
                            <input type="text" class="form-control <?= $dados['telefone_um_erro'] ? 'is-invalid' : '' ?>" name="txtTelefoneUm" id="txtTelefoneUm" value="<?= $dados['txtTelefoneUm'] ?>" maxlength="11">
                            <div class="invalid-feedback"><?= $dados['telefone_um_erro'] ?></div>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="txtTelefoneDois" class="form-label">Telefone 2:</label>
                            <input type="text" class="form-control" name="txtTelefoneDois" id="txtTelefoneDois" value="<?= $dados['txtTelefoneDois'] ?>" maxlength="11">

                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="txtTelefoneEmergencia" class="form-label">Telefone Emergência:</label>
                            <input type="text" class="form-control" name="txtTelefoneEmergencia" id="txtTelefoneEmergencia" value="<?= $dados['txtTelefoneEmergencia'] ?>" maxlength="11">
                        </div>

                        <div class="mb-3 col-sm-6">
                            <label for="cboCasa" class="form-label">N° Casa: *</label>
                            <select class="form-select <?= $dados['cboCasa_erro'] ? 'is-invalid' : '' ?>" name="cboCasa" id="cboCasa">
                                <option value="NULL"></option>
                                <?php foreach ($dados['casas'] as $casa) {
                                    //Resgata valor do select 
                                    $casaSelected = '';
                                    if ($casa->id_casa == $dados['cboCasa']) {
                                        $casaSelected = 'selected';
                                    }
                                ?>
                                    <option <?= $casaSelected ?> value="<?= $casa->id_casa ?>"><?= $casa->ds_numero_casa ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback"><?= $dados['cboCasa_erro'] ?></div>
                        </div>
                    </div>


                    <div class="d-flex">
                        <div class="p-2">
                            <input type="submit" value="Cadastrar" class="btn btn-primary">
                        </div>
                        <div class="p-2">
                            <a class="btn btn-secondary" href="<?= URL . 'Usuarios/visualizarUsuarios' ?>" role="button">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>