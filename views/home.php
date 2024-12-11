<?php
    
$this->layout('template', ['title' => 'TP TFT']);


?>

<h1>TFT - Set <?= $this->e($tft_set_name) ?></h1>

<?= $message ?? "" ?>

<?php

foreach($list_units as $unit) {
    $unit->__toString();
}

?>


