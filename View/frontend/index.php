<?php

$title = 'Bienvenue sur mon blog';
$h1 = 'Le développeur qu\'il vous faut !';
$span = '<span class="subheading">Blog PHP en orienté objet sans Framework !</span>';
$image = 'home-bg.jpg';
$classHeader = 'site-heading';


ob_start();
if(!is_null($articles))
{
    foreach ($articles as $article) {
        echo '<div class="post-preview">
    <a href="index.php?page=show_article&id='.$article['article']->getId().'">
        <h2 class="post-title">
            '.$article['article']->getTitle().'
        </h2>
        <h3 class="post-subtitle">
            '.$article['article']->getHeaderText().'
        </h3>
    </a>
    <p class="post-meta">';
        if($article['article']->getEditDate()!='') echo 'Modifié '; else echo 'Publié ';
        echo 'par
        '.ucfirst($article['user']->getPseudo()).' ';
        if (!empty($article['category']->getName()))
            echo 'dans <a href="index.php?page=category&id='.$article['category']->getId().'">'.$article['category']->getName().'</a> ';
        echo 'le ';
        if($article['article']->getEditDate()!='') echo $article['article']->getEditDate(); else echo $article['article']->getCreationDate();
        echo '</p>
</div>
<hr>';
    }
}
else
{
    echo '<div class="post-preview"><p>Pas encore d\'articles dans cette catégorie.</p></div>';
}

$actualPage = 1;
if(isset($_GET['p']))
    $actualPage = $_GET['p'];

if($pages>1)
{
    echo '<div class="clearfix">';
    if($actualPage>1)
    {
        echo '<a class="btn btn-primary float-left" title="Voir les articles plus récents" href="index.php?';
        if(isset($_GET['page']) && isset($_GET['id']))
            echo 'page=category&id='.$_GET['id'].'&';
        echo 'p='.($actualPage-1).'">&larr; Articles récents</a>';
    }
    if($actualPage!=$pages)
    {
        echo '<a class="btn btn-primary float-right" title="Voir les articles plus anciens" href="index.php?';
        if(isset($_GET['page']) && isset($_GET['id']))
            echo 'page=category&id='.$_GET['id'].'&';
        echo 'p='.($actualPage+1).'">Articles anciens &rarr;</a>';

    }
    echo '</div>';
}
$content = ob_get_clean();

require "View/frontend/template.php";
