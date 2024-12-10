<?php
    $this->layout('template', ['title' => 'TP TFT']);
?>

<h1>Ajouter une unité</h1>

<form action="" method="POST">
    <input type="text" id="name" name="name" placeholder="Nom" maxlength="50" />
    <br />
    <input type="range" id="cost" name="cost" placeholder="Coût" max="5" min="1" />
    <br />
    <input type="text" id="origin" name="origin" placeholder="Origine" maxlength="100" />
    <br />
    <input type="text" id="name" name="name" placeholder="Url de l'image" maxlength="2084" />
    <br />
    <input type="submit" id="submit_button" name="submit_button" value="Ajouter" />
</form>
