<?php include "View/backend/header.php";?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $i; ?> article(s) publié(s)</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">

            <?php
            if (isset($_SESSION['info']))
            {
                echo '<div class="alert alert-info" role="alert">'. $_SESSION['info'] .'</div>';
                unset($_SESSION['info']);
            }
            ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Date création</th>
                    <th scope="col">Date édition</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($articles as $article) {
                    echo '<tr>
                    <th scope="row">'.$article['article']->getId().'</th>
                    <td>'.$article['article']->getTitle().'</td>
                    <td>'.$article['article']->getCreationDate().'</td>
                    <td>'.$article['article']->getEditDate().'</td>
                    <td><a href="index.php?action=admin&page=addOrEditArticle&edit='.$article['article']->getId().'" class="text-info"><i>Modifier</i></a></td>
                    <td><a href="index.php?action=admin&page=listArticle&delete='.$article['article']->getId().'" class="text-danger"><i>Supprimer</i></a></td>
                </tr>';
                }
                ?>

                </tbody>
            </table>

        </div>
    </div>

<?php include "View/backend/footer.php";?>