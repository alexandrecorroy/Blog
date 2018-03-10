<?php


if (isset($article)) {
    $title = "Modifier un article";
} else {
    $title = "Ajouter un article";
}

ob_start();
?>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 500,
                toolbar: [
                    [ 'style', [ 'style' ] ],
                    [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                    [ 'fontname', [ 'fontname' ] ],
                    [ 'fontsize', [ 'fontsize' ] ],
                    [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                    [ 'table', [ 'table' ] ],
                    [ 'insert', [ 'link'] ],
                    [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
                ]
            });
        });
    </script>
<?php
$script = ob_get_clean();
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $title ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">

            <?php
            if (isset($_SESSION['info'])) {
                echo '<div class="alert alert-info" role="alert">'. $_SESSION['info'] .'</div>';
                unset($_SESSION['info']);
            }
            if (isset($_SESSION['alerte'])) {
                echo '<div class="alert alert-danger" role="alert">'. $_SESSION['alerte'] .'</div>';
                unset($_SESSION['alerte']);
            }
            ?>

            <form action="<?php
            if (isset($article)) {
                if (!is_null($article)) {
                    echo 'index.php?action=admin&page=addOrEditArticle&edit='.intval($article['article']->getId());
                } else {
                    echo "index.php?action=admin&page=addOrEditArticle";
                }
            }
            ?>" method="post">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Choisir catégorie</label>
                    <select class="form-control" name="idCategory" id="exampleFormControlSelect1">
                        <option value="0">Aucune</option>
                        <?php
                        foreach ($categories as $category) {
                            $selected = '';
                            if (isset($article)) {
                                if ($article['article']->getIdCategory()==$category->getId()) {
                                    $selected = "Selected";
                                }
                            }
                            echo '<option value="' .$category->getId(). '"'.$selected.'>' .$category->getName(). '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre de l'article" <?php if (isset($article)) {
                            echo 'value="' .$article['article']->getTitle() .'"';
                        } ?>>
                </div>
                <div class="form-group">
                    <label for="entete">Entête</label>
                    <textarea class="form-control" id="entete" name="headerText" placeholder="Votre phrase d'accroche"><?php if (isset($article)) {
                            echo $article['article']->getHeaderText();
                        } ?></textarea>
                </div>
                <div class="form-group">
                    <label for="summernote">Contenu de l'article</label>
                    <textarea class="form-control" id="summernote" name="content" placeholder="Contenu de l'article" rows="15"><?php if (isset($article)) {
                            echo html_entity_decode($article['article']->getContent());
                        } ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><?php
                    if (isset($article)) {
                        echo "Modifier";
                    } else {
                        echo "Ajouter";
                    }
                    ?></button>
            </form>
        </div>
    </div>
<?php
$content = ob_get_clean();

require "View/Backend/template.php";
