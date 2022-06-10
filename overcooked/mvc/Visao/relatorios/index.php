<main>
    <div class="container">
        <div class="ml-3 mt-5">
            <h3>Relatórios</h3>
            <span class="text-muted">
                <a class="header-link" href="<?= URL_RAIZ ?>">Início</a> >
                <a class="header-link" href="<?= URL_RAIZ . 'relatorios' ?>">Relatórios</a>
            </span>
        </div>

        <div class="card m-3 shadow">
            <div class="card-header">
                Relatórios
            </div>

            <div class="card-body mb-5 mt-3">
                <div class="d-flex justify-content-center">
                    <div style="margin-right: 95px">
                        <div class="card shadow" style="width: 16rem;">
                            <img class="card-img-top" src="<?= URL_IMG . 'new-recipe.jpg' ?>" alt="receitas">
                            <div class="card-body">
                                <h5 class="card-title">Total de receitas</h5>
                                <p class="card-text">
                                    <?= $quantidadeReceitas ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="card shadow" style="width: 16rem;">
                            <img class="card-img-top" src="<?= URL_IMG . 'users.jpeg' ?>" alt="usuarios">
                            <div class="card-body">
                                <h5 class="card-title">Total de usuários</h5>
                                <p class="card-text">
                                    <?= $quantidadeUsários ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <a class="btn btn-warning" href="<?= URL_RAIZ ?>">Voltar</a>
        </div>
    </div>
</main>