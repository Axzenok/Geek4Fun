<head>
    <meta charset="utf-8">
    <br><br><br><br><br><br><title>Espace Compte Utilisateur</title>

</head>
<div class="interface">



    <?php if (session()->get('login')) { ?>
        <div class="interface-item">
            <h4>Pseudo</h4>
            <h5><?= session()->get('login'); ?></h5>
            <h5><?= anchor(base_url() . 'Cosplay/updateLogin', "Changer de pseudo", array('class' => 'redirect')); ?></h5>
        </div>

    <?php }

    if (session()->get('mdp')) { ?>
    <div class="interface-item">
        <h4>Mot de passe</h4>
        <h5><?= anchor(base_url() . 'Cosplay/updateMDP', "Changer ton mot de passe", array('class' => 'redirect')); ?></h5>
    </div>
</div>
<?php } ?>