<?php

$title = 'Dashboard';

ob_start();
?>
        <script>

            $(function() {

                Morris.Line({
                    element: 'morris-area-chart',
                    data: [<?php foreach ($yms as $ym) {
    echo '{';
    echo 'period: "'.$ym['date'].'",';
    echo 'articles: '.$ym['articles'].',';
    echo 'commentaires: '.$ym['commentaires'].'';
    echo '},';
}
                        ?>],
                    xkey: 'period',
                    ykeys: ['articles', 'commentaires'],
                    labels: ['Articles', 'Commentaires'],
                    xLabelFormat: function(date) {
                        return (date.getMonth()+1)+'/'+date.getFullYear();
                    },
                    pointSize: 2,
                    hideHover: 'auto',
                    resize: true,
                    dateFormat: function(date) {
                        d = new Date(date);
                        return (d.getMonth()+1)+'/'+d.getFullYear();
                    }
                });

            });



    </script>
<?php
$script = ob_get_clean();

ob_start();
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $countValidatedComments ?></div>
                                <div>Commentaires validés !</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $countArticles ?></div>
                                <div>Articles publiés !</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cogs fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $countCategories ?></div>
                                <div>Catégories !</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $countUnvalidatedComments ?></div>
                                <div>Commentaires en attente de validation !</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Statistique du blog
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="morris-area-chart"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                    <!-- /.panel-heading -->
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

        </div>
    </div>
    <!-- /#wrapper -->

<?php
$content = ob_get_clean();

require "View/Backend/template.php";
