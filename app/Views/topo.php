<header class="artcor">

    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo URL ?>"><?php echo APP_NOME ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="li-a-artcor nav-link" aria-current="page" href="<?php echo URL ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link li-a-artcor" href="<?php echo URL . '/paginas/sobre' ?>">Sobre nós</a>
                        </li>
                    </ul>



                    <?php if (isset($_SESSION['id_usuario'])) { ?>
                        <span class="navbar-text">
                            <p style="color: white;">Olá, <?php echo $_SESSION['ds_nome']; ?>, Seja bem vindo(a)</p>
                            <a class="btn btn-sm btn-danger" href="<?php echo URL . '/usuariosController/sair' ?>">Sair</a>
                        </span>
                    <?php } else { ?>
                        <span class="navbar-text">
                            <a href="<?php echo URL . '/usuariosController/cadastrar' ?>" class="btn btn-artcor">Cadastre-se</a>
                            <a href="<?php echo URL . '/usuariosController/login' ?>" class="btn btn-artcor">Entrar</a>
                        </span>
                    <?php } ?>

                </div>
            </div>
        </nav>
    </div>

</header>