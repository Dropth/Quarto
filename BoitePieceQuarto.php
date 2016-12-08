<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe BoitePieceQuarto
 *
 * @author Dominique Fournier
 * @date 2014/01
 */

require_once("PieceQuarto.php");

/**
 * Permet d'obtenir une image de piece via __toString
 * attention chemin d'accès et nom des fichiers images codés en dur !
 * associe un identifiant unique à l'image --> javascript ?
 */
class BoitePieceQuarto {

  protected $pq;
  public static $compteurVide = 0;

  public function __construct(PieceQuarto $pq = null) {
      
    $this->pq = $pq;
    
  }

  public function __toString() {
      
    if (isset($this->pq)) {
      $hexa = $this->pq->getHexaValue();
      $src = "images/quarto_piece_40px_".$hexa.".png";
      return "<img id='pq".$hexa."' src='".$src."' alt='".$src."' />";
    }
    else {
      $resu = "<img id='pqVide".self::$compteurVide."' src='images/quarto_vide_40px.png' alt='' />";
      self::$compteurVide++;
      return $resu;
    }
  }
}
?>

