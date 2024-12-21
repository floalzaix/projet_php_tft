<?php
    $this->layout('template', ['title' => 'TP TFT']);

    use Helpers\MessageHandler;
?>

<h1>Ajouter/modifier une origine</h1>

<form action="index.php?action=<?= isset($origin) ? "index" : "add-unit-origin"; ?>" method="POST">
    <?php if (isset($origin)) { ?> <!-- Tests if the page is accessed in edit mode -->
        <input type="text" id="name" name="name" value=<?= $origin->getName() ?> maxlength="50" />
        <input type="text" id="url_img" name="url_img" value=<?= $origin->getUrlImg() ?> maxlength="2084" />
        <input type="submit" id="submit_button" name="submit_button" value="Modifier" />
        <input type="hidden" id="id" name="id" value=<?= $origin->getId() ?> />
        <input type="hidden" id="edit_origin" name="edit_origin" value="true" /> <!-- To access the main page in edit mode -->
    <?php } else { ?>
        <input type="text" id="name" name="name" placeholder="Nom" maxlength="50" />
        <input type="text" id="url_img" name="url_img" placeholder="Url de l'image" maxlength="2084" />
        <input type="submit" id="submit_button" name="submit_button" value="Ajouter" />
    <?php } ?>
</form>


<?php MessageHandler::displayMessage("add_origin") ?>