<?php include "View/backend/header.php";?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ajouter un article</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">
            <form action="index.php?action=admin&page=addArticle" method="post">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre de l'article">
                </div>
                <div class="form-group">
                    <label for="entete">Entête</label>
                    <textarea class="form-control" id="entete" name="headerText" placeholder="Votre phrase d'accroche"></textarea>
                </div>
                <div class="form-group">
                    <label for="contenu">Contenu de l'article</label>
                    <textarea class="form-control" id="contenu" name="content" placeholder="Contenu de l'article" rows="15"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>

<?php include "View/backend/footer.php";?>