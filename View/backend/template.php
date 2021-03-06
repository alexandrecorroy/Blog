<!DOCTYPE html>
<html lang="fr">

<head>

    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap Core CSS -->
    <link href="public/backend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="public/backend/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="public/backend/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="public/backend/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="public/backend/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--  favicon  -->
    <link rel="icon" href="public/favicon.ico" />

</head>

<body>

<?php ob_start(); ?>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-header">
                <span class="navbar-brand"> <?= ucfirst($_SESSION['pseudo']) ?> <?php if (self::checkForAdminRequest()) {
    echo '<a href="index.php?action=admin&page=super_admin_response" ><span class="text-danger"><i class="fa fa-exclamation-triangle"></i> (Demande Admin en attente)</span></a>';
} ?></span>
            </div>
        </div>

        <!-- /.navbar-header -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="index.php"><i class="fa fa-home fa-fw"></i> Retour accueil du site</a>
                    </li>
                    <?php if ($_SESSION['role']>1) {
    echo '<li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Gestion des membres<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="index.php?action=admin&page=user_list">Liste des membres</a>
                            </li>
                            <li>
                                <a href="index.php?action=admin&page=super_admin_response">Demandes admin en attente</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li><a href="index.php?action=admin&page=category"><i class="fa fa-cogs fa-fw"></i> Gestion des catégories</a></li>';
}
                    ?>
                    <?php if ($_SESSION['role']>=1) {
                        echo '<li><a href="index.php?action=admin&page=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                    <li>
                        <a href="index.php?action=admin&page=list_no_validated_comments"><i class="fa fa-comments fa-fw"></i> Commentaires à valider</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pencil fa-fw"></i> Gestion des articles<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="index.php?action=admin&page=addOrEditArticle">Ajouter un article</a>
                            </li>
                            <li>
                                <a href="index.php?action=admin&page=listMyArticles">Modifier/Supprimer mes articles</a>
                            </li>';

                        if($_SESSION['role']==2)
                            echo '<li>
                                <a href="index.php?action=admin&page=listArticles">Liste des articles</a>
                            </li>';

                        echo'</ul>
                        <!-- /.nav-second-level -->
                    </li>';
                    }
                    ?>
                    <?php if ($_SESSION['role']>=0) {
                        echo '<li><a href="index.php?action=admin&page=my_comments"><i class="fa fa-comment fa-fw"></i> Mes commentaires</a></li>';
                    }
                    ?>
                    <?php if ($_SESSION['role']==0) {
                        echo '<li><a href="index.php?action=admin&page=admin_request"><i class="fa fa-user-plus fa-fw"></i> Devenir Administrateur</a></li>';
                    }
                    ?>
                    <li>
                        <a href="index.php?action=admin&page=logout"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
<?php
$menu = ob_get_clean();
if ($_GET['page']!= 'logout' && $_GET['page']!= 'login' && $_GET['page']!= 'signup' || (isset($_SESSION['id']) && $_GET['page']== 'login') || (isset($_SESSION['id']) && $_GET['page']== 'signup')) {
    echo $menu;
}
?>


    <?= $content ?>

    <!-- jQuery -->
    <script src="public/backend/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="public/backend/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="public/backend/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="public/backend/vendor/raphael/raphael.min.js"></script>
    <script src="public/backend/vendor/morrisjs/morris.min.js"></script>
    <?php if (isset($script)) {
    echo $script;
} ?>

    <!-- Custom Theme JavaScript -->
    <script src="public/backend/dist/js/sb-admin-2.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
</body>

</html>
