<main>
    <div class="container">
        <div class="ml-3 mt-5">
            <h3>Criar receita</h3>
            <span class="text-muted">
                <a class="header-link" href="<?= URL_RAIZ . 'receitas'?>">Receitas</a> >
                <a class="header-link" href="<?= URL_RAIZ . 'receitas/' . $receita->getId() ?>">Visualizar receita</a>
            </span>
        </div>

        <?php if ($mensagem) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $mensagem ?>

                <button type="button" class="btn-close close" data-dismiss="alert" aria-label="Close"
                        aria-hidden="true"></button>
            </div>
        <?php endif ?>

        <div class="card m-3">
            <div class="card-header">
                Receita
            </div>
            <div class="card-body">
                <div class="d-flex col-12">
                    <div class="col-8 justify-content-start">
                        <h3><?=$receita->getTitulo()?></h3>
                        <span class="text-muted"><?=$receita->getDescricao()?></span>
                    </div>
                    <div class="col-4">
                        <img src="<?= URL_IMG . 'card-recepies.jpeg' ?>" alt="recipe" style="width: 285px">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>Ingredientes:</strong></p>
                        <?=$receita->getIngredientes()?>
                    </div>
                </div>

                <?php if ($usuario && $usuario->getId() == $receita->getUsuarioId() ) : ?>
                    <div class="row mt-2">
                        <div class="col-2">
                            <a class="btn btn-warning" href="<?= URL_RAIZ . 'receitas/editar/' . $receita->getId() ?>">Editar</a>
                            
                            <span data-toggle="modal" data-target="#delete-modal">
                                <a class="btn btn btn-danger" href="#" >Deletar</a>

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
                                                    <button id="deletar" type="submit" class="btn btn-primary" data-dismiss="modal" onclick="event.preventDefault(); this.parentNode.submit()">Sim</button>
                                                </form>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </span>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <div class="card m-3 shadow">
            <div class="card-header">
                Comentários
            </div>
            <div class="card-body">
            <?php if ($usuario) : ?>
                <form action="<?= URL_RAIZ . 'comentarios/' .$receita->getId() ?>" method="POST">
                    <div class="form-group <?= $this->getErroCss('comentario') ?>">
                        <label for="addcomment">Comentário</label>
                        <textarea class="form-control" id="addcomment" rows="3" required name="comentario"></textarea>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'comentario']) ?>

                        <button type="submit" class="btn btn-success mt-2" style="float: right">Enviar</button>
                    </div>
                </form>
            <?php endif ?>

                <?php foreach ($comentarios as $comentario) : ?>
                    <div class="col-12" style="margin-top: 75px">
                        <div class="row text-right">
                            <span class="text-muted justify-content-end">Publicado em: <?= $comentario->getDataCriacao() ?>, por <?= $comentario->getUsuario()->getNome() ?></span>
                        </div>
                        <div class="form-group d-flex">
                            <i style="font-size: 50px; margin-right: 12px" class="bi bi-person-circle"></i>
                            <textarea class="form-control" id="comment" rows="3" disabled><?= $comentario->getComentario() ?></textarea>

                            <?php if ($usuario && $usuario->getId() == $comentario->getUsuarioId() ) : ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#comment-delete-modal">Deletar</button>
                    
                                <div class="modal fade" id="comment-delete-modal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>Excluir Comentário</h4>

                                                <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"
                                                        aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                Deseja realmente excluir seu comentário?
                                            </div>
                                            <div class="modal-footer">
                                            <form action="<?= URL_RAIZ . 'comentarios/' . $comentario->getId() ?>" method="post">
                                                <input type="hidden" name="_metodo" value="DELETE">
                                                <button id="deletar-comment" type="button" class="btn btn-primary" data-dismiss="modal" onclick="event.preventDefault(); this.parentNode.submit()">Sim</button>
                                            </form>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>

        <div class="mt-5">
            <a class="btn btn-warning" href="<?= URL_RAIZ . 'receitas'?>">Voltar</a>
        </div>


    </div>
</main>

<script>
    $('#deletar').click(function () {
        $('#delete-modal').modal('hide');
    });

    $('#deletar-comment').click(function () {
        $('#comment-delete-modal').modal('hide');
    });
</script>