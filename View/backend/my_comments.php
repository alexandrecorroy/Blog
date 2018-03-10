<?php

$title = 'Mes commentaires';

ob_start();
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mes commentaires</h1>
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

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Date création</th>
                    <th scope="col">Dernière modification</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                    <th scope="col">Voir article</th>

                </tr>
                </thead>
                <tbody>
                <?php
                if (!is_null($comments)) {
                    foreach ($comments as $comment) {
                        echo '<tr>
                    <th scope="row">';
                        if ($comment->getIsValidated()) {
                            echo 'Publié';
                        } else {
                            echo 'En attente';
                        }
                        echo'</th>
                    <td>'.$comment->getTitle().'</td>
                    <td>'.$comment->getCreationDate().'</td>
                    <td>'.$comment->getEditDate().'</td>
                    <td><a href="index.php?action=admin&page=edit_my_comment&edit='.$comment->getId().'" class="text-info"><i>Modifier</i></a></td>
                    <td><a href="index.php?action=admin&page=my_comments&delete='.$comment->getId().'&token='.$_SESSION['token'].'" class="text-danger"><i>Supprimer</i></a></td>
                    <td><a href="index.php?page=show_article&id='.$comment->getIdArticle().'#comments" target="_blank" class="text-success"><i>Ouvrir</i></a></td>

                </tr>';
                    }
                } else {
                    echo '<td class="text-center" colspan="7">Vous n\'avez pas encore posté de commentaires !</td>';
                }

                ?>

                </tbody>
            </table>

        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php
$content = ob_get_clean();

require "View/Backend/template.php";
