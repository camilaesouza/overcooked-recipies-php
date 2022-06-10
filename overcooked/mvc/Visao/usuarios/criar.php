<main class="login-form mt-5">
  <div class="container">
      <div class="row justify-content-center">

          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Registre-se</div>
                  <div class="card-body">
                      <form action="<?= URL_RAIZ . 'usuarios' ?>" method="POST">
                          <div class="form-group row <?= $this->getErroCss('nome') ?>">
                              <label for="nome" class="col-md-4 col-form-label text-md-right">Nome: *</label>
                              <div class="col-md-6">
                                  <input type="text" id="nome" class="form-control" name="nome"
                                      required value="<?= $this->getPost('nome') ?>">

                                      <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
                              </div>
                          </div>
                          <div class="form-group row mt-3 <?= $this->getErroCss('email') ?>">
                              <label for="email"
                                  class="col-md-4 col-form-label text-md-right">E-Mail: *</label>
                              <div class="col-md-6">
                                  <input type="email" id="email" class="form-control" name="email"
                                      required value="<?= $this->getPost('email') ?>">

                                      <?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
                              </div>
                          </div>
                          <div class="form-group row mt-3 <?= $this->getErroCss('senha') ?>">
                              <label for="senha"
                                  class="col-md-4 col-form-label text-md-right">Senha: *</label>
                              <div class="col-md-6">
                                  <input type="password" id="senha" class="form-control"
                                      name="senha" required>

                                      <?php $this->incluirVisao('util/formErro.php', ['campo' => 'senha']) ?>
                              </div>
                          </div>
                          <div class="col-md-6 offset-md-4  mt-3">
                              <button type="submit" class="btn btn-dark text-light">Registrar</button>
                          </div>
                      </form>
                  </div>
              </div>

              <div class="mt-3">
                <a class="btn btn-light" href="<?= URL_RAIZ . 'login' ?>">Ir para login</a>
              </div>
          </div>
      </div>
  </div>
</main>