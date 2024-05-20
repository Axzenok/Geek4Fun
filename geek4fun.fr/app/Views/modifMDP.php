<div class="corps settings">
    <h1><?= $titre; ?></h1>
    <?php
    echo form_open(base_url() . "public/updateLogin");

    echo '<p>';
    echo form_label('Rentrez votre nouveau Login :') . "<br>";



    echo '<p>';
    echo form_label('Login :');

    $data = array(
        'name' => 'login',
        'id' => 'login',
        'value' => set_value('login'),
        'size' => 40,
        'type' => 'login',
        'placeholder' => 'Rentrez le login'
    );

    echo form_input($data);
    echo "</p>"."<p>";
    // echo $validation->getError('login');
    echo "</p>"."<p>";

    echo '</p>';

    $data = array(
        'name' => 'submit_form',
        'content' => "Valider",
        'type' => 'submit'
    );

    echo form_button($data);
    echo "</p>";

    echo form_close();

    ?>
</div>
