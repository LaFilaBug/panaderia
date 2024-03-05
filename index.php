<?php
include 'includes/templates/header.php';
?>
<div class="container content">
    <div class="row">
        <div class="col-sm-4">
            <div class="panel">
                <img src="https://res.cloudinary.com/dbqqjaqqa/image/upload/v1490170457/apple-and-almond-cake_i12bux.jpg" class="img-thumbnail" alt="Imagen">
                <div class="box">
                    <h1 id="content1-headline1">Pasteles</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel">
                <img src="https://res.cloudinary.com/dbqqjaqqa/image/upload/v1490245951/gluten-free-bread-rolls-nut-free-bread-rolls-pale-pete-recipes-paleo-way-seed-rolls_lthh5a.jpg" class="img-thumbnail">
                <div class="box">
                    <h1 id="content1-headline2">Sin gluten</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel">
                <img src="https://res.cloudinary.com/dbqqjaqqa/image/upload/v1490245830/Gluten_Free_Bread_6_-_Copy_rtbcqq.jpg" class="img-thumbnail" alt="Imagen">
                <div class="box">
                    <h1 id="content1-headline3">Pan</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row row-eq-height">
        <div class="col-sm-5 content2">
            <p id="content2-1" class="parrafo">Aquí en Panaderias Pelayo, la panadería es nuestra pasión. ¡Ven y
                visitanos - tus
                papilas gustativas te lo agradecerán!</p>
        </div>
        <div class="col-sm-2">
            <img src="https://res.cloudinary.com/dbqqjaqqa/image/upload/v1490342409/dsc_0114_hgqgai.jpg" class="img-circle">
        </div>
        <div class="col-sm-5 content2">
            <p id="content2-2" class="parrafo">Utilizamos solo los ingredientes más finos y frescos para crear
                pasteles que
                calentarán tu corazón.</p>
        </div>
    </div>
</div>

<div id="carousel" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
    </ol>

    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="https://res.cloudinary.com/dbqqjaqqa/image/upload/v1490351456/carousel1.jpg">
            <div class="carousel-caption">
                <h3>100% Casero</h3>
                <p>Hacemos pasteles caseros utilizando ingredientes 100% naturales</p>
            </div>
        </div>
        <div class="item">
            <img src="https://res.cloudinary.com/dbqqjaqqa/image/upload/v1490276719/carousel2_zxje9g.jpg" alt="Imagen">
            <div class="carousel-caption">
                <h3>Haz tu pedido</h3>
                <p>Llámanos y te llevamos pasteles frescos a tu casa</p>
            </div>
        </div>
        <div class="item">
            <img src="https://res.cloudinary.com/dbqqjaqqa/image/upload/v1490276801/carousel3_heh2hy.jpg" alt="Imagen">
            <div class="carousel-caption">
                <h3>100% Casero</h3>
                <p>Hacemos pasteles caseros utilizando ingredientes 100% naturales</p>
            </div>
        </div>
        <div class="item">
            <img src="https://res.cloudinary.com/dbqqjaqqa/image/upload/v1490276736/carousel4_iuwmrn.jpg" alt="Imagen">
            <div class="carousel-caption">
                <h3>Haz tu pedido</h3>
                <p>Llámanos y te llevaremos pasteles frescos a tu casa</p>
            </div>
        </div>
    </div>

    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>



<?php
include 'includes/templates/footer.php';
?>