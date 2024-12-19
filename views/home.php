<?php
    
$this->layout('template', ['title' => 'TP TFT']);


?>

<h1>TFT - Set <?= $this->e($tft_set_name) ?></h1>

<?= $message ?? "" ?>

<div class="body_home">
    <div class="list_units">
        <?php
            foreach($list_units as $unit) {
                $unit->__toString();
            }
        ?>  
    </div>
    <div class="list_origins">
        <?php
            foreach ($list_origins as $origin) {
                $origin->__toString();
            }
        ?>
    </div>
</div>


