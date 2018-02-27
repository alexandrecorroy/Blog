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
                <?= ucfirst($article['user']->getPseudo()) ?> <?php if(!empty($article['category']->getName())) echo 'dans <a href="index.php?page=category&id='.$article['category']->getId().'">'.$article['category']->getName().'</a> '; ?>
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
                <p><?= $article['article']->getContent() ?></p>
            </div>
        </div>
    </div>
</article>


                <?php
                if($totalComments>0)
                {
                    echo '<!-- Comments -->
<hr>
<aside>
    <div class="container">
        <div class="row">';
                    echo '<div class="col-lg-8 col-md-10 mx-auto"><h2 class="section-heading">'.$totalComments.' commentaire(s)</h2></div>';
                    foreach ($comments as $comment) {
                        echo '<div class="col-lg-8 col-md-10 mx-auto mb-4"><div class="panel panel-white post panel-shadow">
                    <div class="post-description">
                        <h5>'.$comment['comment']->getTitle().'</h5>
                        <p>'.$comment['comment']->getContent().'</p>
                        <p class="text-right"><em>Publié le '.$comment['comment']->getCreationDate().' par '.ucfirst($comment['user']->getPseudo()).'.</em></p>
                    </div>
                </div></div>';
                    }
                    echo '        </div>
    </div>
</aside>';
                }
                ?>


<!-- Comments forms -->
<hr>
<aside id="comment" >
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="section-heading">Ajouter un commentaire</h2>
<?php

if(isset($_SESSION['id']))
{
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

    echo '<form action="index.php?page=show_article&id='.$article['article']->getId().'#comment" method="post">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label for="content">Votre message</label>
                        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>';
}
else
{
    echo '<p>Vous devez être <a href="index.php?action=admin&page=login">connecté</a> pour poster un commentaire !</p>';
}

?>

            </div>
        </div>
    </div>
</aside>

<?php include "View/frontend/footer.php";?>