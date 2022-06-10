<main class="login-form mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Erro</div>
                    <div class="card-body text-center">
						<h4>Oh não! Você não tem acesso para essa tela.</h4>
                        <p class="text-muted">Talvez você precisa estar logado para isso!</p>

						<div class="row mt-2">
							<div class="col-12">
								<img src="<?= URL_IMG . 'Erro.png' ?>" alt="profile" style="width: 190px;">
							</div>

							<div class="mt-5">
								<a class="btn btn-dark text-white" href="<?= URL_RAIZ ?>">Ir para inicio</a>
                                <a class="btn btn-dark text-white" href="<?= URL_RAIZ . 'login' ?>">Ir para login</a>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>