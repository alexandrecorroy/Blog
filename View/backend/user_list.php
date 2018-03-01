<?php include "View/backend/header.php";?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Liste des membres du site</h1>
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
                    <th scope="col">id</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Supprimer</th>

                </tr>
                </thead>
                <tbody>
                <?php
                if(!is_null($users))
                {
                    foreach ($users as $user) {
                        echo '<tr>
                    <th scope="row">'.$user->getId().'</th>
                    <td>'.$user->getPseudo().'</td>
                    <td>'.$user->getEmail().'</td>
                    <td>'.$user->getRole().'</td>
                    <td><a href="index.php?action=admin&page=user_list&delete='.$user->getId().'" class="text-danger"><i class="fa fa-trash"></i> Supprimer</a></td>

                </tr>';
                    }
                }
                else
                {
                    echo '<td colspan="7" class="text-center">Pas d\'utilisateurs à renseigner !</td>';
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

