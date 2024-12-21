<?php

namespace Models;

class Unit {
    private ?string $id;
    private string $name;
    private int $cost;
    private array $origins;
    private string $url_img;

    public function __construct(string $name, int $cost, string $url_img) {
        $this->createId();
        $this->name = $name;
        $this->cost = $cost;
        $this->origins = [];
        $this->url_img = $url_img;
    }

    /**
     * Summary of getRarity
     * Returns the rarity of the unit knowing that the cost is the rarity.
     * @return int
     */
    public function getRarity():int {
        return $this->cost;
    }

    /**
     * Summary of __toString
     * Display unit.
     * @return string
     */
    public function __toString(): string {
        echo "<div class=\"unit\">";

            echo "<div class=\"rar_{$this->getRarity()}\" style=\"background-image: url({$this->getUrlImg()})\">"; //Background and rarity 
                echo "<div class=\"name\">".$this->name."</div>"; //Displays the name of the unit

                echo "<div class=\"origins\">"; //Display the origins of the unit using its incorporate method.
                    foreach ($this->getOrigins() as $origin) {
                        echo "<div class=\"origin\">".$origin->incorporate()."</div>";
                    }
                echo "</div>";

                echo "<div class=\"cost\">"; //Display the cost of the unit
                    echo "<img src=\"../public/images/pieces.png\" alt=\"Modifier\" class=\"cost_ico\" />"; //The coin image
                    echo $this->cost; //The cost
                echo "</div>";

                echo "<div class=\"btn_unit\">"; //Display the buttons 

                    echo "<form class=\"btn_small\" action=\"index.php\" method=\"GET\">";
                        echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"edit-unit\" />";
                        echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"{$this->getId()}\" />";
                        echo "<button type=\"submit\" id=\"btn_modif_unit\" class=\"btn_small\">";
                            echo "<img src=\"../public/images/crayon.png\" alt=\"Modifier\" class=\"btn_ico\" />"; //The edit icon
                        echo "</button>";
                    echo "</form>";

                    echo "<form class=\"btn_small\" action=\"index.php\" method=\"GET\">";
                        echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"del-unit\" />";
                        echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"{$this->getId()}\" />";

                        echo "<button type=\"submit\" id=\"btn_delete_unit\" class=\"btn_small\">"; 
                            echo "<img src=\"../public/images/supprimer.png\" alt=\"Modifier\" class=\"btn_ico\" />"; //The del icon
                        echo "</button>";
                    echo "</form>";

                echo "</div>";
                
            echo "</div>";

        echo "</div>";

        return "Ceci est l'affichage de l'unité : ".$this->name;
    }

    //Getters and setters
    public function getId(): ?string {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getCost(): int {
        return $this->cost;
    }
    public function getOrigins() : array {
        return $this->origins;
    }
    public function getUrlImg(): string {
        return $this->url_img;
    }

    /**
     * Summary of createID
     * Create a unique id with uniqid.
     * @return void
     */
    public function createID() : void {
        $this->id = uniqid("unit_");
    }

    public function setId(string $id) : void {
        $this->id = $id;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }
    public function setCost(int $cost): void {
        $this->cost = $cost;
    }
    public function setOrigins(array $origins): void {
        $this->origins = $origins;
    }
    public function setUrlImg(string $url_img): void {
        $this->url_img = $url_img;
    }
}
