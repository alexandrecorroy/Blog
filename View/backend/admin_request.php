<?php

$title = 'Devenir Administrateur';

ob_start();
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Devenir administrateur</h1>
                <p>Pour devenir administrateur et commencer à écrire des articles, vous devez décrire vos motivations pour ce poste. Vous recevrez un mail en cas d'acceptation. Une seule demande par compte.</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <?php
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
                ?>
                <div class="panel panel-default">
                    <?php
                    if($request->getId()==null)
                        echo '<div class="panel-heading">
                        <i class="fa fa-pencil fa-fw"></i> Vos motivations
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form action="index.php?action=admin&page=admin_request" method="post">
                            <div class="form-group">
                                <textarea name="request" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Faire la demande</button>
                        </form>
                        <!-- /.list-group -->
                    </div>';
                    elseif($request->getId()!=null)
                    {
                        echo '<div class="panel-heading">
                        <i class="fa fa-pencil fa-fw"></i> Votre demande
                    </div>
                    <!-- /.panel-heading -->
                        <p>'.$request->getRequest().'</p>
                        <p>Status de la demande : ';
                        if($request->getStatus()==0) echo "En cours";
                        if($request->getStatus()==1) echo "Refusée";
                        echo '</p>
                        <p></div>';
                    }
                    ?>
                    <!-- /.panel-body -->
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php
$content = ob_get_clean();

require "View/Backend/template.php";
