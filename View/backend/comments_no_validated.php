<?php include "View/backend/header.php";?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Commentaires en attente de validation</h1>
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
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date création</th>
                    <th scope="col">Dernière modification</th>
                    <th class="text-center" scope="col">Supprimer</th>
                    <th class="text-center" scope="col">Valider</th>

                </tr>
                </thead>
                <tbody>
                <?php
                if(!is_null($comments))
                {
                    foreach ($comments as $comment) {
                        echo '<tr>
                    <th scope="row">'.$comment['user']->getPseudo().'</th>
                    <td>'.$comment['comment']->getTitle().'</td>
                    <td>'.$comment['comment']->getContent().'</td>
                    <td>'.$comment['comment']->getCreationDate().'</td>
                    <td>'.$comment['comment']->getEditDate().'</td>
                    <td class="text-center"><a href="index.php?action=admin&page=list_no_validated_comments&do=delete&id='.$comment['comment']->getId().'" class="text-danger"><i class="fa fa-trash"></i></a></td>
                    <td class="text-center"><a href="index.php?action=admin&page=list_no_validated_comments&do=validate&id='.$comment['comment']->getId().'" class="text-success"><i class="fa fa-check"></i></a></td>

                </tr>';
                    }
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

<?php include "View/backend/footer.php";?>