<article><br><br>

    <div class="background">
        <!--- Css utile que pour la page Connexion --->
        <?= link_tag('/Cosplay/css/Connexion.css')?>
        <div class="corps">
            <!--- Formulaire de connexion--->
<?php
//mise en places des sessions
$session = \Config\Services::session();
//récupération des données de sessions associées au flash
if (! $session->getFlashdata('resultConnect')){
    ?><?php
}else{ ?><h4><?php
    echo $session->getFlashdata('resultConnect'); ?> </h4> <?php
}

echo form_open(base_url()."Cosplay/Connexion");?><div class="formulaire"><h4>
                    <?=$Titre;?></h4></div><?php

echo '<p>';
echo form_label('Login : ');
$date=array(
    'name' => 'login',
    'id' => 'login',
    'class' => 'input',
    'value' => set_value('login'),
    'maxlength' => 50,
    'placeholder' => 'Login',
    'size' =>50);
echo form_input($date);
echo '</p>'.'<p>';
echo '</p>'.'<p class="erreur">';
echo $validation->getError('login');

echo '<p>';
echo form_label('Mot de Passe : ');
$date=array(
    'name' => 'password',
    'id' => 'password',
    'type' => 'password',
    'class' => 'input',
    'value' => set_value('password'),
    'maxlength' => 50,
    'placeholder'=>'Mot de passe',
    'size' =>50);
echo form_input($date);
echo '</p>'.'<p>';
echo '</p>'.'<p class="erreur">';
echo $validation->getError('password');

echo '<p>';
$date=array(
    'name' => 'submit',
    'id'=>'submit',
    'value' =>'Valider',
    'class' => 'button'
);
echo form_submit($date);
echo '</p>'.'<p>';

echo form_close();
?><br>
    </div>
</article>