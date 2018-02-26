<?php
include "View/frontend/header.php";?>
<!-- Page Header -->
<header class="masthead" style="background-image: url('public/frontend/images/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Le développeur qu'il vous faut !</h1>
                    <span class="subheading">Blog PHP en orienté objet !</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

            <?php
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
                <p class="post-meta">Publié par
                    <a href="#">'.ucfirst($article['user']->getPseudo()).'</a>
                    le '.$article['article']->getCreationDate().'</p>
            </div>
            <hr>';
            }
            ?>


            <!-- Pager -->
            <?php
            $actualPage = 0;
            if(isset($_GET['page']))
                $actualPage = $_GET['page'];

            if($pages>1)
            {
                echo '<div class="clearfix">';
                if($actualPage>1)
                    echo '<a class="btn btn-primary float-left" title="Voir les articles plus récents" href="index.php?page='.($actualPage-1).'">&larr; Articles récents</a>';
                if($actualPage!=$pages)
                    echo '<a class="btn btn-primary float-right" title="Voir les articles plus anciens" href="index.php?page='.($actualPage+1).'">Articles anciens &rarr;</a>';
                echo '</div>';
            }


            ?>


        </div>
    </div>
</div>
<?php include "View/frontend/footer.php";?>