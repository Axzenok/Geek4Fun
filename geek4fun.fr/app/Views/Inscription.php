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

            echo form_open(base_url()."Cosplay/Inscription");?><div class="formulaire"><h4>
                <?=$Titre;?></h4></div><?php
            echo '<p>';
            echo form_label('Nom : ');
            $date=array(
                'name' => 'nom',
                'id' => 'nom',
                'class' => 'input',
                'value' => set_value('nom'),
                'maxlength' => 50,
                'placeholder'=>'Votre Nom de Famille',
                'size' =>50);
            echo form_input($date);
            echo '</p>'.'<p>';
            echo '</p>'.'<p class="erreur">';
            echo $validation->getError('nom');
            echo '<p>';

            echo form_label('Prenom : ');
            $date=array(
                'name' => 'prenom',
                'id' => 'prenom',
                'class' => 'input',
                'value' => set_value('prenom'),
                'maxlength' => 50,
                'placeholder'=>'Votre Prénom',
                'size' =>50);
            echo form_input($date);
            echo '</p>'.'<p>';
            echo '</p>'.'<p class="erreur">';
            echo $validation->getError('prenom');
            echo '<p>';

            echo form_label('Date de naissance : ');
            $date=array(
                'name' => 'dateNaiss',
                'id' => 'dateNaiss',
                'class' => 'input',
                'type' => 'date',
                'value' => set_value('dateNaiss'),
                'maxlength' => 50,
                'placeholder'=>'Votre Date de Naissance',
                'size' =>50);
            echo form_input($date);
            echo '</p>'.'<p>';
            echo '</p>'.'<p class="erreur">';
            echo $validation->getError('dateNaiss');
            echo '<p>';

            echo form_label('E-mail : ');
            $date=array(
                'name' => 'email',
                'id' => 'email',
                'class' => 'input',
                'type' => 'email',
                'value' => set_value('email'),
                'maxlength' => 50,
                'placeholder'=>'Votre Adresse E-mail',
                'size' =>50);
            echo form_input($date);
            echo '</p>'.'<p>';
            echo '</p>'.'<p class="erreur">';
            echo $validation->getError('email');
            echo '<p>';

            echo form_label('Numéro de telephone : ');
            $date=array(
                'name' => 'telephone',
                'id' => 'telephone',
                'class' => 'input',
                'type' => 'tel',
                'value' => set_value('telephone'),
                'maxlength' => 50,
                'placeholder'=>'Votre Numéro de telephone',
                'size' =>50);
            echo form_input($date);
            echo '</p>'.'<p>';
            echo '</p>'.'<p class="erreur">';
            echo $validation->getError('telephone');
            echo '<p>';

            echo form_label('Ville : ');
            $date=array(
                'name' => 'ville',
                'id' => 'ville',
                'class' => 'input',
                'value' => set_value('ville'),
                'maxlength' => 50,
                'placeholder'=>'Votre Ville',
                'size' =>50);
            echo form_input($date);
            echo '</p>'.'<p>';
            echo '</p>'.'<p class="erreur">';
            echo $validation->getError('ville');
            echo '<p>';

            echo form_label('Login : ');
            $date=array(
                'name' => 'login',
                'id' => 'login',
                'class' => 'input',
                'value' => set_value('login'),
                'maxlength' => 50,
                'placeholder' => 'Votre Identifiant de Connexion',
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
                'placeholder'=>'Votre Mot de passe',
                'size' =>50);
            echo form_input($date);
            echo '</p>'.'<p>';
            echo '</p>'.'<p class="erreur">';
            echo $validation->getError('password');
            echo '<p>';

            echo form_label('Confirmer votre Mot de Passe : ');
            $date=array(
                'name' => 'password2',
                'id' => 'password2',
                'type' => 'password',
                'class' => 'input',
                'value' => set_value('password2'),
                'maxlength' => 50,
                'placeholder'=>'Confirmer Votre Mot de passe',
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