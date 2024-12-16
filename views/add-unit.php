<?php
    $this->layout('template', ['title' => 'TP TFT']);
?>

<h1>Ajouter/modifier une unité</h1>

<form action="index.php?action=<?= isset($unit) ? "index" : "add-unit"; ?>" method="POST">
    <?php if (isset($unit)) { ?>
        <input type="text" id="name" name="name" maxlength="50" value="<?= $unit->getName(); ?>" />
        <br />
        <input type="range" id="cost" name="cost" max="5" min="1" value="<?= $unit->getCost(); ?>" />
        <br />
        <input type="text" id="origin" name="origin" maxlength="100" value="<?= $unit->getOrigins(true); ?>" />
        <br />
        <input type="text" id="url_img" name="url_img"  maxlength="2084" value=<?= $unit->getUrlImg(); ?> />
        <input type="hidden" id="id" name="id" value="<?= $unit->getId(); ?>" />
        <input type="hidden" id="edit_unit" name="edit_unit" value="true" />
        <br />
        <input type="submit" id="submit_button" name="submit_button" value="Modifier" />
    <?php } else { ?>
        <input type="text" id="name" name="name" placeholder="Nom" maxlength="50" />
        <br />
        <input type="range" id="cost" name="cost" placeholder="Coût" max="5" min="1" value="1"/>
        <br />
        <input type="text" id="origin" name="origin" placeholder="Origine" maxlength="100" />
        <br />
        <input type="text" id="url_img" name="url_img" placeholder="Url de l'image" maxlength="2084" />
        <br />
        <input type="submit" id="submit_button" name="submit_button" value="Ajouter" />
    <?php } ?>
</form>

<div><?= $this->e($message) ?></div>
