<main>
    <div id="carouselExampleIndicators" class="carousel slide p-2" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= URL_IMG . 'slide12.jpg' ?>" class="w-100" alt="slide1">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= URL_IMG . 'slide2.jpg' ?>" class="d-block w-100" alt="slide2">
            </div>
            <div class="carousel-item">
                <img src="<?= URL_IMG . 'slide3.jpg' ?>" class="d-block w-100" alt="slide3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <div class="row p-5">
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?= URL_IMG . 'card1.png' ?>" alt="card1" style="width:60%">
                    <div class="card-body">
                        <h5 class="card-title">Conheça receitas</h5>
                        <p class="card-text">
                            No overcooked receitas, temos variadades de receitas para você inovar na sua cozinha!
                        </p>
                    </div>
                    <div class="card-body">
                        <a href="<?= URL_RAIZ . 'receitas' ?>" class="card-link">Veja aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?= URL_IMG . 'card2.png' ?>" alt="card1" style="width:53%">
                    <div class="card-body">
                        <h5 class="card-title">Cadastre suas receitas</h5>
                        <p class="card-text">
                            Você pode contribuir com nossa comunidade adicionando suas próprias receitas, venha fazer parte
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?= URL_IMG . 'card3.png' ?>" alt="card1" style="width:60%">
                    <div class="card-body">
                        <h5 class="card-title">Variedades culturais</h5>
                        <p class="card-text">
                            Em nossa comunidade temos vários tipos de receitas, para abranger todo o mundo, não perca!
                        </p>
                    </div>
                    <div class="card-body">
                        <a href="<?= URL_RAIZ . 'receitas' ?>" class="card-link">Veja aqui</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="container">
        <div class="row p-5">
            <div class="col-md-7">
                <h2>
                    Inove em sua cozinha -
                    <span class="text-muted">Venha para o nossa comunidade</span>
                </h2>
                <p>Com a ajuda das pessoas, podemos aumentar nossa variedade de receitas e sermos cada dia melhor, seja um chef overcooked e ajude!</p>
            </div>
            <div class="col-md-5">
                <img src="<?= URL_IMG . 'page1.jpg' ?>" alt="new-recipe" style="width:90%">
            </div>
        </div>
    </div>

    <hr>

    <div class="container">
        <div class="row p-5">
            <div class="col-md-5">
                <img src="<?= URL_IMG . 'page2.jpg' ?>" alt="new-recipe" style="width:90%">
            </div>
            <div class="col-md-7">
                <h2>
                    Seu jantar especial -
                    <span class="text-muted">Temos um mundo da cozinha esperando por você</span>
                </h2>
                <p>
                    Queremos ajudar ao máximo os chefs overcooked, seja pra impressionar sua família ou aquela pessoa especial,
                    aqui temos várias delicioas receitas para você arrasar na cozinha!
                </p>
            </div>
        </div>
    </div>
</main>