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
        <select id="origin1" name="origin1">
            <?php 
                echo "<option value='NULL'>Vide</option>";
                foreach($origins as $origin) {
                    if ($origin == $unit->getOrigins()[0]) {
                        echo "<option value='{$origin->getId()}' selected>{$origin->getName()}</option>";
                    } else {
                        echo "<option value='{$origin->getId()}'>{$origin->getName()}</option>";
                    }
                }
            ?>
        </select>
        <select id="origin2" name="origin2" value="<?= ($unit->getOrigins()[1] != null) ? $unit->getOrigins()[1]->getId() : ""; ?>">
            <?php 
                echo "<option value='NULL'>Vide</option>";
                foreach($origins as $origin) {
                    if ($origin == $unit->getOrigins()[1]) {
                        echo "<option value='{$origin->getId()}' selected>{$origin->getName()}</option>";
                    } else {
                        echo "<option value='{$origin->getId()}'>{$origin->getName()}</option>";
                    }
                }
            ?>
        </select>
        <select id="origin3" name="origin3" value="<?= ($unit->getOrigins()[2] != null) ? $unit->getOrigins()[2]->getId() : ""; ?>">
            <?php 
                echo "<option value='NULL'>Vide</option>";
                foreach($origins as $origin) {
                    if ($origin == $unit->getOrigins()[2]) {
                        echo "<option value='{$origin->getId()}' selected>{$origin->getName()}</option>";
                    } else {
                        echo "<option value='{$origin->getId()}'>{$origin->getName()}</option>";
                    }
                }
            ?>
        </select>
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
        <select id="origin1" name="origin1">
            <?php 
                echo "<option value='NULL'>Vide</option>";
                foreach($origins as $origin) {
                    echo "<option value='{$origin->getId()}'>{$origin->getName()}</option>";
                }
            ?>
        </select>
        <select id="origin2" name="origin2">
            <?php
                echo "<option value='NULL'>Vide</option>"; 
                foreach($origins as $origin) {
                    echo "<option value='{$origin->getId()}'>{$origin->getName()}</option>";
                }
            ?>
        </select>
        <select id="origin3" name="origin3">
            <?php 
                echo "<option value='NULL'>Vide</option>";
                foreach($origins as $origin) {
                    echo "<option value='{$origin->getId()}'>{$origin->getName()}</option>";
                }
            ?>
        </select>
        <br />
        <input type="text" id="url_img" name="url_img" placeholder="Url de l'image" maxlength="2084" />
        <br />
        <input type="submit" id="submit_button" name="submit_button" value="Ajouter" />
    <?php } ?>
</form>

<div><?= $this->e($message) ?></div>
