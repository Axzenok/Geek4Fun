<?= link_tag('/Cosplay/css/TableStyle.css')?>
<br><br><br>
<article>
    <h2>Liste des utilisateurs</h2>

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
                <th> Modification </th>
                <th> Suppression </th>
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
                    <td><?php
                        echo form_open(base_url()."Cosplay/Modifier");?><div class="boutounModif"><h4><?php
                        echo form_hidden('id', $user['utilisateur_id']);
                        echo form_submit([
                            'name' => 'submit',
                            'id' => 'submit',
                            'value' => 'Modifier',
                            'class' => 'butonModif'
                        ]);

                        echo form_close();
                            ?></td>
                    <td><?php
                        echo form_open(base_url()."Cosplay/Supprimer");?><div class="boutonSupp"><h4><?php
                        echo form_hidden('id', $user['utilisateur_id']);
                        echo form_submit([
                            'name' => 'submit',
                            'id' => 'submit',
                            'value' => 'Supprimer',
                            'class' => 'butonSupp'
                        ]);

                        echo form_close();
                        ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>

</article>