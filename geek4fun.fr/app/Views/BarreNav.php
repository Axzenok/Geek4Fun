<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Cosplay_Are</title>
    <link rel="icon" href="/Cosplay/image/logo/G4F_ter.png" type="image/gif" />
    <!--- lien css et javascript que j'utilise--->
    <?= link_tag('/Cosplay/css/Carousel.css'); ?>
    <?= link_tag('/Cosplay/css/Footer.css')?>
    <?= link_tag('/Cosplay/css/BarreNav.css')?>
    <?= link_tag('/Cosplay/css/Body.css')?>
</head>
<body>
<nav>
    <div class="wrapper">
        <!--- insertion du logo --->
        <div class="logo"><?php
            $proprieteImage = [
                'src' => '/Cosplay/image/logo/logo.png',
                'alt' => 'Logo',
                'class' => 'logo'];
            echo img($proprieteImage);
            ?></div>
        <!--- Navbar avec toutes les redirections--->
        <input type="radio" name="slider" id="menu-btn">
        <input type="radio" name="slider" id="close-btn">
        <ul class="nav-links">
            <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
            <li><?=anchor(base_url() . 'Cosplay/', 'Accueil')?></li>
            <li>
                <?=anchor(base_url() . 'Cosplay/', 'Information')?>
                <input type="checkbox" id="showDrop">
                <label for="showDrop" class="mobile-item">Dropdown Menu</label>
                <ul class="drop-menu">
                    <li><?=anchor(base_url() . 'Cosplay/reglementation', 'Réglementation')?></li>
                    <li><?=anchor(base_url() . 'Cosplay/lots', 'Les Lots')?></li>
                    <li><?=anchor(base_url() . 'Cosplay/note', 'Système de Note')?></li>
                </ul>
            </li>
            <li>
                <a href="#" class="desktop-item">Menu Complet</a>
                <input type="checkbox" id="showMega">
                <label for="showMega" class="mobile-item">Mega Menu</label>
                <div class="mega-box">
                    <div class="content">
                        <div class="row">
                            <?php
                            $proprieteImage = [
                                'src' => '/Cosplay/image/logo/imgNavBar.jpg',
                                'alt' => 'CosplayBarreNav',
                                'class' => 'imgNav'];
                            echo img($proprieteImage);
                            ?>
                        </div>
                        <div class="row">
                            <header>Nous Concernant</header>
                            <ul class="mega-links">
                                <li><?=anchor(base_url() . 'Cosplay/Mention', 'Mention Légale')?></li>
                                <li><?=anchor(base_url() . 'Cosplay/Contact', 'Contact')?></li>
                            </ul>
                        </div>
                        <div class="row">
                            <header>Information & Concours</header>
                            <ul class="mega-links">
                                <li><?=anchor(base_url() . 'Cosplay/reglementation', 'Réglementation')?></li>
                                <li><?=anchor(base_url() . 'Cosplay/lots', 'Les Lots')?></li>
                                <li><?=anchor(base_url() . 'Cosplay/note', 'Système de Note')?></li>
                                <li><?=anchor(base_url() . 'Cosplay/', 'Planning')?></li>
                            </ul>
                        </div>
                        <div class="row">
                            <header>Gestion du Compte</header>
                            <ul class="mega-links">
                                <!--- Gestion des acces lors de la connexion --->
                                <?php
                                //pas de session en cours
                                if (!session()->get('login')){ ?>
                                    <li><?=anchor(base_url() . 'Cosplay/Connexion', 'Connexion')?></li>
                                    <li><?=anchor(base_url() . 'Cosplay/Inscription', 'Inscription')?></li>
                                <?php }else if (session()->get('id')==1){ ?>
                                    <li><?=anchor(base_url() . 'Cosplay/Administrateur', 'Administrateur')?></li>
                                    <li><?=anchor(base_url() . 'Cosplay/compte', 'Compte')?></li>
                                    <li><?=anchor(base_url() . 'Cosplay/Deconnexion', 'Déconnexion')?></li>
                                <?php }else if (session()->get('id')==3){ ?>
                                    <li><?=anchor(base_url() . 'Cosplay/compte', 'Compte Jury')?></li>
                                    <li><?=anchor(base_url() . 'Cosplay/Deconnexion', 'Déconnexion')?></li>
                                <?php }else { ?>
                                    <li><?=anchor(base_url() . 'Cosplay/compte', 'Compte')?></li>
                                    <li><?=anchor(base_url() . 'Cosplay/Deconnexion', 'Déconnexion')?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <?php
            //pas de session en cours
            if (!session()->get('login')){ ?>
            <li><?=anchor(base_url() . 'Cosplay/Connexion', 'Connexion')?></li>
            <?php }else{ ?>
            <li><?=anchor(base_url() . 'Cosplay/Deconnexion', 'Déconnexion')?></li>
            <?php } ?>
        </ul>
        <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
    </div>
</nav>
<br><br>