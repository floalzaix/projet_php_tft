<?php
    $this->layout('template', ['title' => 'TP TFT']);
?>

<h1>Ajouter une unité</h1>

<form action="index.php?action=add-unit" method="POST">
    <input type="text" id="name" name="name" placeholder="Nom" maxlength="50" />
    <br />
    <input type="range" id="cost" name="cost" placeholder="Coût" max="5" min="1" value="1"/>
    <br />
    <input type="text" id="origin" name="origin" placeholder="Origine" maxlength="100" />
    <br />
    <input type="text" id="url_img" name="url_img" placeholder="Url de l'image" maxlength="2084" />
    <br />
    <input type="submit" id="submit_button" name="submit_button" value="Ajouter" />
</form>

<div><?= $this->e($message) ?></div>
