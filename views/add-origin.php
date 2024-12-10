<?php
    $this->layout('template', ['title' => 'TP TFT']);
?>

<h1>Ajouter une origine</h1>

<form action="" method="POST">
    <input type="text" id="name" name="name" placeholder="Nom" maxlength="50" />
    <br />
    <input type="text" id="name" name="name" placeholder="Url de l'image" maxlength="2084" />
    <br />
    <input type="submit" id="submit_button" name="submit_button" value="Ajouter" />
</form>