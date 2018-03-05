<?php

$title = $article['article']->getTitle();
$h1 = $article['article']->getTitle();
$h2 = '<h2 class="subheading">'.$article['article']->getHeaderText().'</h2>';
$image = 'post-bg.jpg';
$classHeader = 'post-heading';

ob_start();
?>
<span class="meta"><?php if($article['article']->getEditDate()!='') echo 'Modifié '; else echo 'Posté '; ?>par
                <?= ucfirst($article['user']->getPseudo()) ?> <?php if(!empty($article['category']->getName())) echo 'dans <a href="index.php?page=category&id='.$article['category']->getId().'">'.$article['category']->getName().'</a> '; ?>
                le <?php if($article['article']->getEditDate()!='') echo $article['article']->getEditDate(); else $article['article']->getCreationDate(); ?></span>
<?php
$span = ob_get_clean();
$content = $article['article']->getContent();

ob_start();
                if($totalComments>0)
                {
                    echo '<!-- Comments -->
<hr>
<aside id="comments">
    <div class="container">
        <div class="row">';
                    echo '<div class="col-lg-8 col-md-10 mx-auto"><h2 class="section-heading">'.$totalComments.' commentaire(s)</h2></div>';
                    foreach ($comments as $comment) {
                        echo '<div class="col-lg-8 col-md-10 mx-auto mb-4"><div class="panel panel-white post panel-shadow">
                    <div class="post-description">
                        <h5>'.$comment['comment']->getTitle().'</h5>
                        <p>'.$comment['comment']->getContent().'</p>
                        <p class="text-right"><em>';
                        if($comment['comment']->getEditDate()!='') echo 'Modifié '; else echo 'Publié ';
                        echo 'le ';
                        if($comment['comment']->getEditDate()!='') echo $comment['comment']->getEditDate(); else echo $comment['comment']->getCreationDate();
                        echo ' par '.ucfirst($comment['user']->getPseudo()).'.</em></p>
                    </div>
                </div></div>';
                    }
                    echo '        </div>
    </div>
</aside>';
                }

echo '<!-- Comments forms -->
<hr>
<aside id="comment" >
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="section-heading">Ajouter un commentaire</h2>';

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

$more = ob_get_clean();

require "View/frontend/template.php";
