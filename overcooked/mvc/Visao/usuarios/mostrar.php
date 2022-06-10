<main>
    <div class="container">
        <div class="ml-3 mt-5">
            <h3>Perfil</h3>
            <span class="text-muted">
                <a class="header-link" href="<?= URL_RAIZ ?>">Início</a> >
                <a class="header-link" href="<?= URL_RAIZ . 'usuarios' ?>">Perfil</a>
            </span>
        </div>
        <div class="card m-3 shadow">
            <div class="card-header">
                Seu perfil
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Nome:</strong></p>
                        <p style="font-size: 18px"><?=$usuario->getNome()?></p>
                    </div>

                    <div class="col-md-4">
                        <p><strong>Email:</strong></p>
                        <p style="font-size: 18px"><?=$usuario->getEmail()?></p>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <img src="<?= URL_IMG . 'profile.jpg' ?>" alt="profile" style="width: 150px; float: right">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <a class="btn btn-warning" href="<?= URL_RAIZ ?>">Voltar</a>
        </div>
    </div>
</main>