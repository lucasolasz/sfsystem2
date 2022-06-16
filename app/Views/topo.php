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
                        <?php if (isset($_SESSION['id_usuario'])) {
                            if ($_SESSION['fk_tipo_usuario'] == 1) { ?>
                                
                                <li class="nav-item">
                                    <a class="li-a-artcor nav-link" aria-current="page" href="<?php echo URL ?>">Home</a>
                                </li>

                                <li class="nav-item dropdown">

                                    <a class="li-a-artcor nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Cadastro</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-artcor nav-link" aria-current="page" href="<?php echo URL . '/usuariosController/cadastrar' ?>">Usuário</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">

                                    <a class="li-a-artcor nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Encontros literários</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-artcor nav-link" aria-current="page" href="<?php echo URL . '/agendaController' ?>">Agenda Convidados</a></li>
                                    </ul>
                                </li>
                        <?php }
                        } ?>

                        <li class="nav-item">
                            <a class="nav-link li-a-artcor" href="<?php echo URL . '/paginas/sobre' ?>">Sobre nós</a>
                        </li>
                    </ul>

                    <?php if (isset($_SESSION['id_usuario'])) { ?>
                        <span class="navbar-text">
                            <p style="color: white;">Olá, <?php echo ucfirst($_SESSION['ds_nome_usuario']); ?>, Seja bem vindo(a)</p>
                            <a class="btn btn-sm btn-danger" href="<?php echo URL . '/usuariosController/sair' ?>">Sair</a>
                        </span>
                    <?php } else { ?>
                        <span class="navbar-text">
                            <a href="<?php echo URL . '/usuariosController/login' ?>" class="btn btn-artcor">Entrar</a>
                        </span>
                    <?php } ?>

                </div>
            </div>
        </nav>
    </div>

</header>