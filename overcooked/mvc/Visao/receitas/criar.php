<head>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= URL_JS . 'jquery-te-1.4.0.min.js' ?>" charset="utf-8"></script>
</head>

<main>
    <div class="container">
        <div class="ml-3 mt-5">
            <h3>Criar receita</h3>
            <span class="text-muted">
                <a class="header-link" href="<?= URL_RAIZ . 'receitas'?>">Receitas</a> >
                <a class="header-link" href="<?= URL_RAIZ . 'receitas/criar'?>">Criar receita</a>
            </span>
        </div>

        <div class="card m-3">
            <div class="card-header">
                Criar
            </div>
            <div class="card-body">
                <form action="<?= URL_RAIZ . 'receitas/criar' ?>" method="POST" class="margin-bottom">
                    <div class="form-row">
                        <div class="form-group col-md-12 <?= $this->getErroCss('titulo') ?>">
                            <label for="titulo">Título: *</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Título" name="titulo" value="<?= $this->getPost('titulo') ?>">
                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'titulo']) ?>
                        </div>
                        <div class="form-group col-md-12 mt-3 <?= $this->getErroCss('descricao') ?>">
                            <label for="descricao">Descrição: *</label>
                            <input type="text" class="form-control" id="descricao" placeholder="Descrição" name="descricao" value="<?= $this->getPost('descricao') ?>">
                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'descricao']) ?>
                        </div>

                        <div class="form-group col-md-12 mt-3 <?= $this->getErroCss('ingredientes') ?>">
                            <label for="ingredientes">Ingredientes: *</label>
                            <textarea id="ingredientes" name="ingredientes" class="jqte-test"><?= $this->getPost('ingredientes') ?></textarea>
                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'ingredientes']) ?>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <img src="<?= URL_IMG . 'profile.jpg'?>" alt="profile" style="width: 150px; float: right">
                        </div>

                        <div class="col-12">
                          <button type="submit" class="btn btn-dark text-light">Criar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-5">
            <a class="btn btn-warning" href="<?= URL_RAIZ . 'receitas'?>">Voltar</a>
        </div>
    </div>
</main>

<script>
    $('.jqte-test').jqte();

    var jqteStatus = true;
    $(".status").click(function () {
        jqteStatus = jqteStatus ? false : true;
        $('.jqte-test').jqte({"status": jqteStatus})
    });
</script>