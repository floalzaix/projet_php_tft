<?php

namespace Models;

class Unit {
    private ?string $id;
    private string $name;
    private int $cost;
    private string $origin;
    private string $url_img;

    public function __construct(string $name, int $cost, string $origin, string $url_img) {
        $this->setId();
        $this->name = $name;
        $this->cost = $cost;
        $this->origin = $origin;
        $this->url_img = $url_img;
    }

    public function getRarity():int {
        return $this->cost;
    }

    //toString
    public function __toString(): string {
        $origins = explode(",", $this->origin);
        
        echo "<div class=\"unit\">";

            echo "<div class=\"rar_{$this->getRarity()}\" style=\"background-image: url({$this->getUrlImg()})\">";
                echo "<div class=\"name\">".$this->name."</div>";

                echo "<div class=\"origins\">";
                    foreach ($origins as $origin) {
                        echo "<div class=\"origin\">".$origin."</div>";
                    }
                echo "</div>";

                echo "<div class=\"cost\">";
                    echo "<img src=\"../public/images/pieces.png\" alt=\"Modifier\" class=\"cost_ico\" />";
                    echo $this->cost;
                echo "</div>";

                if (isset($_SERVER["PHP_SELF"])) {
                    echo "<div class=\"btn_unit\">";

                        echo "<form class=\"btn_small\" action=\"".basename($_SERVER["PHP_SELF"])."\" method=\"GET\">";
                            echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"edit-unit\" />";
                            echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"{$this->getId()}\" />";

                            echo "<button type=\"submit\" id=\"btn_modif_unit\" class=\"btn_small\">";
                                echo "<img src=\"../public/images/crayon.png\" alt=\"Modifier\" class=\"btn_ico\" />";
                            echo "</button>";
                        echo "</form>";

                        echo "<form class=\"btn_small\" action=\"".basename($_SERVER["PHP_SELF"])."\" method=\"GET\">";
                            echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"del-unit\" />";
                            echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"{$this->getId()}\" />";

                            echo "<button type=\"submit\" id=\"btn_delete_unit\" class=\"btn_small\">";
                                echo "<img src=\"../public/images/supprimer.png\" alt=\"Modifier\" class=\"btn_ico\" />";
                            echo "</button>";
                        echo "</form>";

                    echo "</div>";
                }
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
    public function getOrigin(): string {
        return $this->origin;
    }
    public function getUrlImg(): string {
        return $this->url_img;
    }

    public function setId(): void {
        $this->id = uniqid("unit_");
    }
    public function setName(string $name): void {
        $this->name = $name;
    }
    public function setCost(int $cost): void {
        $this->cost = $cost;
    }
    public function setOrigin(string $origin): void {
        $this->origin = $origin;
    }
    public function setUrlImg(string $url_img): void {
        $this->url_img = $url_img;
    }
}
