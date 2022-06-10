<main class="login-form mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <?php if ($mensagem) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $mensagem ?>

                        <button type="button" class="btn-close close" data-dismiss="alert" aria-label="Close"
                                aria-hidden="true"></button>
                    </div>
                <?php endif ?>

                <div class="card">
                    <div class="card-header">Conecte-se</div>
                    <div class="card-body">
                        <form action="<?= URL_RAIZ . 'login' ?>" method="post">
                            <div class="form-group row">
                                <label for="emailUsuario"
                                       class="col-md-4 col-form-label text-md-right control-label">E-Mail:</label>
                                <div class="col-md-6">
                                    <input type="text" id="emailUsuario" class="form-control" name="login"
                                           required autofocus value="<?= $this->getPost('login') ?>">
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="senhaUsuario"
                                       class="col-md-4 col-form-label text-md-right control-label">Senha:</label>
                                <div class="col-md-6">
                                    <input type="password" id="senhaUsuario" class="form-control"
                                           name="senha" required>
                                </div>
                            </div>
                            <div class="form-group has-error text-center">
                              <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
                            </div>

                            <div class="col-md-6 offset-md-4 mt-3">
                                <button type="submit" class="btn btn-dark text-light">Entrar</button>
                                <a href="<?= URL_RAIZ . 'usuarios/criar' ?>" class="text-muted float-right">
                                    Registre-se
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



