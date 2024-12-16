<?php
    $this->layout('template', ['title' => 'TP TFT']);
?>

<h1>Ajouter/modifier une origine</h1>

<form action="index.php?<?= !isset($origin) ? "" : "add-unit-origin"; ?>" method="POST">
    <?php if (isset($origin)) { ?>
        <input type="text" id="name" name="name" value=<?= $origin->getName() ?> maxlength="50" />
        <br />
        <input type="text" id="url_img" name="url_img" value=<?= $origin->getUrlImg() ?> maxlength="2084" />
        <br />
        <input type="submit" id="submit_button" name="submit_button" value="Modifier" />
        <input type="hidden" id="id" name="id" value=<?= $origin->getId() ?> />
        <input type="hidden" id="edit_origin" name="edit_origin" value="true" />
    <?php } else { ?>
        <input type="text" id="name" name="name" placeholder="Nom" maxlength="50" />
        <br />
        <input type="text" id="url_img" name="url_img" placeholder="Url de l'image" maxlength="2084" />
        <br />
        <input type="submit" id="submit_button" name="submit_button" value="Ajouter" />
    <?php } ?>
</form>

<div><?= $this->e($message) ?></div>