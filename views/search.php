<?php
    use Models\Unit;

    $this->layout('template', ['title' => 'TP TFT']);

    $model = new Unit("exemple", "1", "url_img");
    $props = (new ReflectionClass($model))->getProperties();
?>

<h1>Recherche</h1>

<div class="body_search">
    <form method="POST" action="index.php?action=search">
        <input type="text" id="search_field" name="search_field" placeholder="Recherche ..." />
        <select id="search_select" name="search_select">
            <option value="">Champs</option>
            <?php
                foreach ($props as $prop) {
                    echo "<option value='" . $prop->getName() . "'>" . $prop->getName() . "</option>";
                }

            ?>
        </select>
        <input type="submit" id="submit_button" name="submit_button" value="Rechercher" />
    </form>

    <div class="message"> <?= $message ?> </div>
     
    <?php if (!empty($content) && get_class($content[0]) == "Models\Unit") {?> 
        <div class="list_units">
            <?php 
                foreach($content as $thing) {
                    $thing->__toString();
                }
            ?>
        </div>
    <?php } else { ?>
        <div class="list_origins">
            <?php 
                foreach($content as $thing) {
                    $thing->__toString();
                }
            ?>
        </div>
    <?php } ?>
</div>