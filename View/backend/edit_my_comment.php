<?php

$title = 'Modifier un commentaire';

ob_start();
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Modifier son commentaire
                </h1>
                <p>La modification entraine une revalidation du commentaire par le staff.</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">

            <?php
            if (isset($_SESSION['info'])) {
                echo '<div class="alert alert-info" role="alert">'. $_SESSION['info'] .'</div>';
                unset($_SESSION['info']);
            }
            if (isset($_SESSION['alerte'])) {
                echo '<div class="alert alert-danger" role="alert">'. $_SESSION['alerte'] .'</div>';
                unset($_SESSION['alerte']);
            }
            ?>

            <form action="index.php?action=admin&page=edit_my_comment&edit=<?= $comment->getId() ?>" method="post">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre de l'article" value="<?= $comment->getTitle() ?>">
                </div>
                <div class="form-group">
                    <label for="contenu">Votre message</label>
                    <textarea class="form-control" id="contenu" name="content" placeholder="Contenu de l'article" rows="15"><?= $comment->getContent() ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
<?php
$content = ob_get_clean();

require "View/backend/template.php";
