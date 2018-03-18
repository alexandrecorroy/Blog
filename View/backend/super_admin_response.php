<?php

$title = 'Demandes role administrateur';

ob_start();
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Demandes status administrateur</h1>
                <p>Liste des demandes des membres souhaitant devenir administrateur.</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (isset($_SESSION['info'])) {
                    echo '<div class="alert alert-info" role="alert">'. $_SESSION['info'] .'</div>';
                    unset($_SESSION['info']);
                }
                ?>

                <?php
                if ($requests!==null) {
                    foreach ($requests as $request) {
                        echo '                        <div class="panel panel-default mb-5">
                            <div class="panel-heading">
                                <i class="fa fa-user fa-fw"></i> '.$request['user']->getPseudo().'
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="list-group">
                                    <p>'.$request['request']->getRequest().'</p>
                                </div>
                                <!-- /.list-group -->
                            </div>
                            <!-- /.panel-body -->
                            <div class="panel-footer">
                                <a href="index.php?action=admin&page=super_admin_response&response=true&id='.$request['request']->getId().'&token='.$_SESSION['token'].'"><span class="btn btn-success mb-2">Accepter la demande</span></a>
                                <a class="pull-right" href="index.php?action=admin&page=super_admin_response&response=false&id='.$request['request']->getId().'&token='.$_SESSION['token'].'"><span class="btn btn-danger mb-2">Refuser la demande</span></a>
                            </div>
                        </div>';
                    }
                } else {
                    echo'<p class="text-center">Aucune demande pour l\'instant</p>';
                }

                ?>

            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php
$content = ob_get_clean();

require "View/backend/template.php";
