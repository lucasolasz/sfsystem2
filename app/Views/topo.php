<header class="bg-dark">

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
                            <a class="nav-link" aria-current="page" href="<?php echo URL ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL.'/paginas/sobre'?>">Sobre nós</a>
                        </li>
                    </ul>

                    <span class="navbar-text">
                        <a href="<?php echo URL.'/usuarios/cadastrar'?>" class="btn btn-secondary">Cadastre-se</a>
                        <a href="" class="btn btn-secondary">Entrar</a>

                    </span>
                    <!-- <form class="d-flex">
                        <button class="btn btn-success me-2" type="button" href >Cadastre-se</button>
                        <button class="btn btn-success me-2" type="button">Entrar</button>
                    </form> -->
                </div>
            </div>
        </nav>
    </div>

</header>