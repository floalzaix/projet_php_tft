<?php

namespace Models;

class Origin {
    private string $id;
    private string $name;
    private string $url_img;
    
    public function __construct(string $name, string $url_img) {
        $this->createId();
        $this->name = $name;
        $this->url_img = $url_img;
    }

    public function incorporate() : void {
        echo "<img class='' src='{$this->getUrlImg()}' ";
        echo "<div>{$this->getName()}</div>";
    }

    public function __toString() : string {
        echo "<div>";

            echo "<img class='' src='{$this->getUrlImg()}' ";

            echo "<div>{$this->getName()}</div>";

            echo "<form class=\"btn_small\" action='index.php' method='GTE'>";
                echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"edit-origin\" />";
                echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"{$this->getId()}\" />";

                echo "<button type=\"submit\" id=\"btn_modif_unit\" class=\"btn_small\">";
                    echo "<img src=\"../public/images/crayon.png\" alt=\"Modifier\" class=\"btn_ico\" />";
                echo "</button>";
            echo "</form>";

            echo "<form class='btn_small' action='index.php' method='GET'>";
                echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"del-origin\" />";
                echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"{$this->getId()}\" />";

                echo "<button type=\"submit\" id=\"btn_delete_unit\" class=\"btn_small\">";
                    echo "<img src=\"../public/images/supprimer.png\" alt=\"Modifier\" class=\"btn_ico\" />";
                echo "</button>";
            echo "</form>";

        echo "</div>";
        return "Ceci est une l'affichage de l'origine : ".$this->name;
    }

    public function createId() : void {
        $this->id = uniqid("origin_");
    }

    //Getters and setters
    public function getId() : string {
        return $this->id;
    }
    public function getName() : string {
        return $this->name;
    }
    public function getUrlImg() : string {
        return $this->url_img;
    }

    public function setId($id) : void {
        $this->id = $id;
    }
    public function setName(string $name) : void {
        $this->name = $name;
    }
    public function setUrlImg(string $url_img) : void {
        $this->url_img = $url_img;
    }
}

?>