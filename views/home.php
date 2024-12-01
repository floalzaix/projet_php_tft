<?php
    
$this->layout('template', ['title' => 'TP TFT']);


?>

<h1>TFT - Set <?= $this->e($tft_set_name) ?></h1>



<?php

foreach($list_units as $unit) {
    $unit->__toString();
}

?>
<!--

<?php var_dump($list_units); ?>
<br />
<?php var_dump($first); ?>
<br />
<?php var_dump($other); ?>
-->

