<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/02/2018
 * Time: 14:49
 */
?>
<?php include "View/backend/header.php";?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Inscription</h3>
                    </div>
                    <?php
                    if(isset($_SESSION['alerte']))
                    {
                        echo '<div class="alert alert-danger">'.$_SESSION['alerte'].'</div>';
                        unset($_SESSION['alerte']);
                    }


                    ?>
                    <div class="panel-body">
                        <form role="form" action="index.php?action=admin&page=login" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Pseudo" name="pseudo" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="email" type="email" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="S'enregistrer" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
                <a href="index.php" class="text-info">&larr; Retour sur le site</a>
            </div>
        </div>
    </div>
<?php include "View/backend/footer.php";?>