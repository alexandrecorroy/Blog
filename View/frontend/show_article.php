<?php include "View/frontend/header.php";?>
<!-- Page Header -->
<header class="masthead" style="background-image: url('public/frontend/images/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1><?= $article['article']->getTitle() ?></h1>
                    <h2 class="subheading"><?= $article['article']->getHeaderText() ?></h2>
                    <span class="meta">Posté par
                <a href="#"><?= ucfirst($article['user']->getPseudo()) ?></a>
                le <?= $article['article']->getCreationDate() ?></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <?= $article['article']->getContent() ?>
            </div>
        </div>
    </div>
</article>

<!-- Comments -->


<!-- Comments forms -->
<hr>
<aside id="comment">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="section-heading">Ajouter un commentaire</h2>
                <?php
                if (isset($_SESSION['info']))
                {
                    echo '<div class="alert alert-info" role="alert">'. $_SESSION['info'] .'</div>';
                    unset($_SESSION['info']);
                }
                if (isset($_SESSION['alerte']))
                {
                    echo '<div class="alert alert-danger" role="alert">'. $_SESSION['alerte'] .'</div>';
                    unset($_SESSION['alerte']);
                }
                ?>
                <form action="index.php?action=public&page=show_article&id=<?= $article['article']->getId() ?>#comment" method="post">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label for="content">Votre message</label>
                        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</aside>


<?php include "View/frontend/footer.php";?>