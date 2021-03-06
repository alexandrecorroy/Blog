<?php

$title = 'Connexion au panel d\'administration';

ob_start();
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Connexion panel administration</h3>
                    </div>
                    <?php
                    if (isset($_SESSION['alerte'])) {
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
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Se connecter" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                        <a href="index.php?action=admin&page=signup" class="text-info">Pas encore de compte ? Devenir membre !</a>
                    </div>
                </div>
                <a href="index.php" class="text-info">&larr; Retour sur le site</a>
            </div>
        </div>
    </div>
<?php
$content = ob_get_clean();

require "View/backend/template.php";
