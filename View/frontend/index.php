<?php
include "View/frontend/header.php";?>
<!-- Page Header -->
<header class="masthead" style="background-image: url('public/frontend/images/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Alexandre CORROY</h1>
                    <span class="subheading">Le développeur qu'il vous faut !</span>
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
                <a href="index.php?action=public&page=show_article&id_article='.$article['article']->getId().'">
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
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>
        </div>
    </div>
</div>
<?php include "View/frontend/footer.php";?>