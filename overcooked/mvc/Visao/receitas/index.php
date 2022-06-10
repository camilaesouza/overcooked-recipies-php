<main>
    <div class="container">
        <div class="ml-3 mt-5">
            <h3>Receitas</h3>
            <span class="text-muted">
                <a class="header-link" href="<?= URL_RAIZ?>">Início</a> >
                <a class="header-link" href="<?= URL_RAIZ . 'receitas'?>">Receitas</a>
            </span>
        </div>

        <?php if ($mensagem) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $mensagem ?>

                <button type="button" class="btn-close close" data-dismiss="alert" aria-label="Close"
                        aria-hidden="true"></button>
            </div>
        <?php endif ?>

        <div class="card m-3 container shadow">
            <div class="d-flex mt-3">
                <div class="col-8">
                    <form action="<?= URL_RAIZ . 'receitas' ?>" method="POST" class="d-flex">
                        <div class="col-10">
                            <input class="form-control" type="search" name="query" placeholder="Busque por ingredientes da receita" value="<?= $this->getPost('query') ?>">
                        </div>

                        <div class="m-15">
                            <button class="btn btn-info" type="submit"><i class="bi bi-search"></i> Buscar</button>
                        </div>
                    </form>
                </div>

                <div class="m-15">
                    <?php if ($usuario) : ?>
                        <a href="<?= URL_RAIZ . 'receitas/criar' ?>" class="btn btn-warning">
                            <i class="fa fa-plus"></i> <i class="bi bi-plus"></i> Criar Receita
                        </a>
                    <?php endif ?>
                </div>

                <form action="<?= URL_RAIZ . 'receitas' ?>" method="POST" class="d-flex justify-content-start m-15">
                    <?php if ($ordenar == 'desc') : ?>
                        <button class="btn btn-info" data-toggle="tooltip" name="ordenar" value="asc" title="Ordenar por data  crescente"> <i class="bi bi-arrow-up-short"></i> Ordenar listagem</button>
                    <?php endif ?>
                    <?php if ($ordenar == 'asc') : ?>
                        <button class="btn btn-info" data-toggle="tooltip" name="ordenar" value="desc" title="Ordenar por data decrescente"> <i class="bi bi-arrow-down-short"></i> Ordenar listagem</button>
                    <?php endif ?>
                </form>
            </div>
            <div class="row m-3">
            <?php if (empty($receitas)) : ?>
                <h5 class="text-center">Nenhuma receita cadastrada!</h5>
            <?php endif ?>
            <?php foreach ($receitas as $receita) : ?>
                <div class="card shadow" style="width: 16rem;">
                        <img class="card-img-top" src="<?= URL_IMG . 'card-recepies.jpeg'?>" alt="card1">
                        <div class="card-body">
                            <h5 class="card-title"><?= $receita->getTitulo() ?></h5>
                            <p class="card-text">
                                <?= $receita->getDescricao() ?>
                            </p>
                            <span class="text-muted">
                                <?= $receita->getDataCriacao() ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <a href="<?= URL_RAIZ . 'receitas/' . $receita->getId() ?>" data-toggle="tooltip" title="Visualizar" class="btn btn-primary btn-sm">
                                <i class="bi bi-search"></i>
                            </a>
                    
                            <?php if ($usuario && $usuario->getId() == $receita->getUsuarioId() ) : ?>
                                <a href="<?= URL_RAIZ . 'receitas/editar/' . $receita->getId() ?>" data-toggle="tooltip" title="Editar" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <span data-toggle="modal" data-target="#delete-modal">
                                    <a class="btn-sm btn btn-danger" data-toggle="tooltip" href="#" data-placement="top"
                                    title="Deletar">
                                    <i class="bi bi-backspace"></i>
                                    </a>

                                    <div class="modal fade" id="delete-modal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>Excluir Item</h4>

                                                    <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"
                                                            aria-hidden="true"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja realmente excluir este item?
                                                </div>
                                                <div class="modal-footer">
                                                <form action="<?= URL_RAIZ . 'receitas/' . $receita->getId() ?>" method="post">
                                                    <input type="hidden" name="_metodo" value="DELETE">
                                                    <a href="" id="deletar" class="btn btn-primary" data-dismiss="modal" onclick="event.preventDefault(); this.parentNode.submit()">Sim</a>
                                                </form>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            <?php endif ?>
                        </div>
                    </div>
            <?php endforeach ?>
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if ($pagina > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= URL_RAIZ . 'receitas?p=' . ($pagina-1) ?>">Anterior</a>
                        </li>
                    <?php endif ?>

                    <?php for ($i = 1; $i <= $ultimaPagina; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="<?= URL_RAIZ . 'receitas?p=' . ($i) ?>"> <?= $i ?></a></li>
                    <?php endfor ?>

                    <?php if ($pagina < $ultimaPagina) : ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= URL_RAIZ . 'receitas?p=' . ($pagina+1) ?>">Próxima</a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>

        <div class="mt-5">
            <a class="btn btn-warning" href="<?= URL_RAIZ?>">Voltar</a>
        </div>
    </div>
</main>

<script>
    $('#deletar').click(function () {
        $('#delete-modal').modal('hide');
    });

</script>
