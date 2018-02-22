<?php include "View/backend/header.php";?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Gestion des catégories</h1>
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
            if (isset($_SESSION['alerte']))
            {
                echo '<div class="alert alert-danger" role="alert">'. $_SESSION['alerte'] .'</div>';
                unset($_SESSION['alerte']);
            }
            ?>

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-cog fa-fw"></i> Ajouter une catégorie
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form action="index.php?action=admin&page=category" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="MaCatégorie">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
                        </form>
                        <!-- /.list-group -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-cogs fa-fw"></i> Liste des catégories
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                                <?php
                                foreach ($categories as $category) {
                                    echo '<span class="list-group-item"><i class="fa fa-cog fa-fw"></i> ' .$category->getName(). '<a href="index.php?action=admin&page=category&delete='.$category->getId().'"><span class="pull-right text-muted small text-danger"><em>Supprimer</em></span></a></span>';
                                }
                                ?>
                        </div>
                        <!-- /.list-group -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "View/backend/footer.php";?>