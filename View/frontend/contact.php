<?php

$title = 'Contactez Moi';
$h1 = 'Contactez Moi';
$span = '<span class="subheading">Vous avez une question ? Nous avons une réponse.</span>';
$image = 'contact-bg.jpg';
$classHeader = 'site-heading';


ob_start();

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
            <p>Pour me contacter, merci de remplir ce formulaire de contact. Une réponse vous sera apporter au plus vite !</p>

            <form name="sentMessage" id="contactForm" action="index.php?page=contact" method="post">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="Nom" id="name" name="name" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Adresse Email</label>
                        <input type="email" class="form-control" placeholder="Addresse email" id="email" name="email" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Sujet</label>
                        <input type="text" class="form-control" placeholder="Sujet" id="subject" name="subject" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Message</label>
                        <textarea rows="5" class="form-control" placeholder="Message" id="message" name="message" required></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyer</button>
                </div>
            </form>
<?php
$content = ob_get_clean();

require "View/frontend/template.php";