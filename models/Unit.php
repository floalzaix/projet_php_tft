<?php

namespace Models;

class Unit {
    private ?string $id;
    private string $name;
    private int $cost;
    private string $origin;
    private string $url_img;

    public function __construct(string $id, string $name, int $cost, string $origin, string $url_img) {
        $this->id = $id;
        $this->name = $name;
        $this->cost = $cost;
        $this->origin = $origin;
        $this->url_img = $url_img;
    }

    //toString
    public function __toString(): string {
        echo "<div id=\"unit\" style=\"background-image: url(\"{$this->getUrlImg()}\")\">";
            echo $this->getUrlImg();
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

    public function setId(string $id): void {
        $this->id = $id;
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
