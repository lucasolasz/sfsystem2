<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div class="card">
        <div class="card-body">
            <h2>Cadastro de Usuário</h2>
            <small>Preencha o formulário abaixo para cadastrar um novo usuário</small>

            <form name="cadastrar" method="POST" action="<?php echo URL ?>/usuariosController/cadastrar">
                <div class="mb-3">
                    <label for="txtNome" class="form-label">Nome: *</label>
                    <input type="text" class="form-control <?php echo $dados['nome_erro'] ? 'is-invalid' : '' ?>" name="txtNome" id="txtNome" value="<?php echo $dados['txtNome'] ?>">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?php echo $dados['nome_erro']?></div>
                </div>
                <div class="mb-3">
                    <label for="txtEmail" class="form-label">E-mail: *</label>
                    <input type="text" class="form-control <?php echo $dados['email_erro'] ? 'is-invalid' : '' ?>" name="txtEmail" id="txtEmail" value="<?php echo $dados['txtEmail'] ?>">
                    <div class="invalid-feedback"><?php echo $dados['email_erro']?></div>
                </div>
                <div class="mb-3">
                    <label for="txtSenha" class="form-label">Senha: *</label>
                    <input type="password" class="form-control <?php echo $dados['senha_erro'] ? 'is-invalid' : '' ?>" name="txtSenha" id="txtSenha"
                    value="<?php echo $dados['txtSenha'] ?>">
                    <div class="invalid-feedback"><?php echo $dados['senha_erro']?></div>
                </div>
                <div class="mb-3">
                    <label for="txtConfirmaSenha" class="form-label">Confirmar Senha: *</label>
                    <input type="password" class="form-control <?php echo $dados['confirma_senha_erro'] ? 'is-invalid' : '' ?>" name="txtConfirmaSenha" id="txtConfirmaSenha">
                    <div class="invalid-feedback"><?php echo $dados['confirma_senha_erro']?></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" value="Cadastrar" class="btn btn-primary">
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo URL.'/usuariosController/login'?>">Você tem uma conta? Faça Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>