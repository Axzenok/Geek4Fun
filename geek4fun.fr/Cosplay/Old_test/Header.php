<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Cosplay_Are</title>
    <?php echo link_tag('/Cosplay/css/HeaderStyle.css'); ?>
    <?= link_tag('/Cosplay/css/Carousel.css'); ?>
    <?= link_tag('/Cosplay/javascript/Header.js')?>
</head>
<body>
<!-- Navbar -->
<nav id='menu'>
    <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
    <ul>
        <li><?=anchor(base_url() . 'Cosplay/', 'Accueil')?></li>
        <li><a class='dropdown-arrow' <?=anchor(base_url() . 'Cosplay/', 'Information')?>
            <ul class='sub-menus'>
                <li><?=anchor(base_url() . 'Cosplay/', 'réglementation')?></li>
                <li><?=anchor(base_url() . 'Cosplay/', 'Les Lots')?></li>
                <li><?=anchor(base_url() . 'Cosplay/', 'Système de Note')?></li>
            </ul>
        </li>
        <li><?=anchor(base_url() . 'Cosplay/', 'Planning')?></li>
        <li><?=anchor(base_url() . 'Cosplay/', 'mention légale')?></li>
        <li><?=anchor(base_url() . 'Cosplay/', 'Contact')?></li>
        <li><a class='dropdown-arrow' <?=anchor(base_url() . 'Cosplay/', 'Compte')?>
            <ul class='sub-menus'>
                <li><?=anchor(base_url() . 'Cosplay/', 'Connexion')?></li>
                <li><?=anchor(base_url() . 'Cosplay/', 'Inscription')?></li>
            </ul>
        </li>
        <li><?=anchor(base_url() . 'Cosplay/', 'Déconnexion')?></li>
    </ul>
</nav>