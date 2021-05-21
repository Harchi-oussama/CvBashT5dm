<?php
namespace App\Entity;
class CategorieSearch
{
 private $categorie;
 public function getCategorie(): ?string
 {
 return $this->categorie;
 }
 public function setCategorie(string $categorie): self
 {
 $this->categorie = $categorie;
 return $this;
 }
}