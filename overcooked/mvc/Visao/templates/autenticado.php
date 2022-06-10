<!DOCTYPE html>
<html>
    
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?= URL_CSS . 'jquery-te-1.4.0.css' ?>">

    <link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'my-css.css' ?>">
    <script src="<?= URL_JS . 'bootstrap.min.js' ?>"></script>
    <script src="<?= URL_JS . 'bootstrap.bundle.min.js' ?>"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="icon" href="<?= URL_IMG . 'icon.png' ?>">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg bg-yellow shadow">
        <div class="container">
            <a class="navbar-brand p-0" href="<?= URL_RAIZ ?>">
                <img src="<?= URL_IMG . 'logo.png' ?>" alt="logo" style="width:125px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-1">
                        <a class="nav-link" href="<?= URL_RAIZ ?>"> 
                          <i class="bi bi-house-door"></i> Início
                        </a>
                    </li>
                    <li class="nav-item mr-1">
                        <a class="nav-link" href="<?= URL_RAIZ . 'receitas' ?>">
                            <i class="bi bi-book"></i> Receitas
                        </a>
                    </li>
                    <li class="nav-item mr-1">
                        <a class="nav-link" href="<?= URL_RAIZ . 'relatorios' ?>">
                            <i class="bi bi-bar-chart"></i> Relatórios
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> Perfil
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (empty($usuario)) : ?>
                              <a class="dropdown-item" href="<?= URL_RAIZ . 'login' ?>">Login</a>
                            <?php endif ?>


                            <?php if ($usuario) : ?>
                              <a class="dropdown-item"><?=$usuario->getNome()?></a>
                              <a class="dropdown-item" href="<?= URL_RAIZ . 'usuarios' ?>">Ver Perfil</a>
                              <div class="dropdown-divider"></div>
                              <form action="<?= URL_RAIZ . 'login' ?>" method="post">
                                <input type="hidden" name="_metodo" value="DELETE">
                                <button type="submit" class="btn btn-default btn-block dropdown-item text-muted" size >Sair</button>
                              </form>
                            <?php endif ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<?php $this->imprimirConteudo() ?>

<footer class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <img src="<?= URL_IMG . 'footer.png' ?>" alt="footer" style="width:125px">
            </div>
            <div class="col-sm" style="margin-top: 50px; text-align: center">
                Sistema desenvolvido por:
                <a style="color: white !important;" href="https://github.com/camilaesouza">Camila Souza</a>
            </div>
            <div class="col-sm" style="margin-top: 50px; text-align: center">
                © 2022 Copyright Overcooked recipes
            </div>
            <div class="text-right">
                <a href="#">Voltar ao topo</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
