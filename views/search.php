<?php
    use Models\Unit;

    $this->layout('template', ['title' => 'TP TFT']);

    $model = new Unit("exemple", "1", "url_img");
    $props = (new ReflectionClass($model))->getProperties();
?>

<h1>Recherche</h1>

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

<?php 

echo $message;

foreach($content as $thing) {
    $thing->__toString();
}

?>