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

    /**
     * Summary of incorporate
     * Function to include the origin (display) in a unit in the left bottom corner.
     * @return void
     */
    public function incorporate() : void {
        echo "<div class='incorporated_origin'>";
            echo "<img class='inc_origin_img' src='{$this->getUrlImg()}' />"; //Image
            echo "<div>{$this->getName()}</div>";                             //Name
        echo "</div>";
    }

    /**
     * Summary of __toString
     * Display origin. 
     * @return string
     */
    public function __toString() : string {
        echo "<div class='origin'>";

            echo "<img class='' src='{$this->getUrlImg()}' />"; //Background image

            echo "<div class='origin_name'>{$this->getName()}</div>"; //Display the name of the origin

            /**
             * Display the edit button
             */
            echo "<a class='btn_small' href='index.php?action=edit-origin&id={$this->getId()}'>"; //The button
                echo "<img src=\"../public/images/crayon.png\" alt=\"Modifier\" class=\"btn_ico\" />"; //The edit icon
            echo "</a>";

            /**
             * Display the del button
             */     
            echo "<a class='btn_small' href='index.php?action=del-origin&id={$this->getId()}'>"; //The button
                echo "<img src=\"../public/images/supprimer.png\" alt=\"Modifier\" class=\"btn_ico\" />"; //The del icon
            echo "</a>";

        echo "</div>";
        return "Ceci est une l'affichage de l'origine : ".$this->name;
    }

    /**
     * Summary of createId
     * Creates a random id using uniqid.
     * @return void
     */
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