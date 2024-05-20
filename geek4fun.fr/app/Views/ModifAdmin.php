<?= link_tag('/Cosplay/css/TableStyle.css')?>
<br><br><br>
<article>
    <h2>Modification de <?=$InfoModif;?></h2>

    <?php if ($users): ?>
        <table class="TableStyle">
            <thead>
            <tr>
                <th> Identifiant </th>
                <th> Nom </th>
                <th> Prénom </th>
                <th> Date de Naissance </th>
                <th> Adresse Mail </th>
                <th> Numéro de Téléphone </th>
                <th> Ville </th>
                <th> Login </th>
                <th> Autorisation </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['utilisateur_id']; ?></td>
                    <td><?php echo $user['utilisateur_nom']; ?></td>
                    <td><?php echo $user['utilisateur_prenom']; ?></td>
                    <td><?php echo $user['utilisateur_dateDeNaissance']; ?></td>
                    <td><?php echo $user['utilisateur_mail']; ?></td>
                    <td><?php echo $user['utilisateur_telephone']; ?></td>
                    <td><?php echo $user['utilisateur_ville']; ?></td>
                    <td><?php echo $user['utilisateur_login']; ?></td>
                    <td><?php
                        // Afficher le type d'utilisateur en tant que texte
                        switch ($user['id_type']) {
                            case 1:
                                echo "Administrateur";
                                break;
                            case 2:
                                echo "Utilisateur";
                                break;
                            case 3:
                                echo "Jury";
                                break;
                        }
                        ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>
</article>
<article><br><br>

    <div class="background">
        <!--- Css utile que pour la page Connexion --->
        <div class="corps">
            <!--- Formulaire de modification--->
            <?php
            echo form_open(base_url()."Cosplay/Modifier");?><div class="formulaire"><h4>
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