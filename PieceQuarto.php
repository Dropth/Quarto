<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe PieceQuarto
 *
 * @author Dominique Fournier
 * @date 2014/01
 */
class PieceQuarto {

  /* $signature : tableau associatif composé des quatre caractères d'une pièce :
     bord, couleur, forme, motif 
     chaque caractère peut avoir deux valeurs 0 ou 1
  */
  protected $signature;

  /**
   * méthode de classe isQuarto
   * @param $lesPieces un tableau de 4 PieceQuarto
   * @return true si les quatre pieces ont un caractère commun
   */
  public static function isQuarto($lesPieces) {
      return (($lesPieces[0]->compareCaractere('couleur', $lesPieces[1]) && $lesPieces[0]->compareCaractere('couleur', $lesPieces[2]) && $lesPieces[0]->compareCaractere('couleur', $lesPieces[3]))
	      || ($lesPieces[0]->compareCaractere('bord', $lesPieces[1]) && $lesPieces[0]->compareCaractere('bord', $lesPieces[2]) && $lesPieces[0]->compareCaractere('bord', $lesPieces[3]))
	      || ($lesPieces[0]->compareCaractere('motif', $lesPieces[1]) && $lesPieces[0]->compareCaractere('motif', $lesPieces[2]) && $lesPieces[0]->compareCaractere('motif', $lesPieces[3]))
	      || ($lesPieces[0]->compareCaractere('forme', $lesPieces[1]) && $lesPieces[0]->compareCaractere('forme', $lesPieces[2]) && $lesPieces[0]->compareCaractere('forme', $lesPieces[3]))
	      );
  }

  /**
   *  Constructeur
   *  @param les 4 valeurs des caradctères de la piece
   */
  public function __construct($bord, $couleur, $forme, $motif) {
    $this->signature = array();
    $this->signature['bord'] = $bord;
    $this->signature['couleur'] = $couleur;
    $this->signature['forme'] = $forme;
    $this->signature['motif'] = $motif;
  }

  /**
   * Destructeur
   *
   */
  public function __destruct() {
    /* echo "destruction de ". $this; */
  }

  /**
   * méthode getCaractere
   * @param le caractère consulté
   * @return valeur du caractère 
   */
  public function getCaractere($caractere) {
    return $this->signature[$caractere];
  }

  /**
   * méthode setCaractere
   * @param le caractère modifié et sa nouvelle valeur
   */

  public function setCaractere($caractere, $valeur) {
    return $this->signature[$caractere]=$valeur;
  }

  /**
   * méthode compareCaractere
   * @param caractere à comparer et deuxième pieceQuarto avec laquelle faire la comparaison
   * @return true si this et pieceQuarto on le caractere identique
   */
  public function compareCaractere($caractere, PieceQuarto $pieceQuarto) {
    return ($this->signature[$caractere]==$pieceQuarto->getCaractere($caractere));
  }

  /**
   * méthode getHexaValue
   * @return le code hexadecimal de la pièce avec la fonction dechex
   */

  public function getHexaValue() {
    $valeur = 0;
    $valeur+= $this->signature['motif'];
    $valeur+= $this->signature['forme'] * 2;
    $valeur+= $this->signature['couleur'] * 4;
    $valeur+= $this->signature['bord'] * 8;
    return dechex($valeur);
  }


  /**
   * méthode toString
   * @return une représentation de la piece sous forme de string
   */

  public function __toString() {
    $resu="( #".$this->getHexaValue()." )";
    return $resu;
  }
}

/* Script de test */
/* $pq1 = new PieceQuarto(0,0,0,0); */
/* echo $pq1; */
/* echo "<br />"; */
/* $pq1->setCaractere('forme',1); */
/* echo $pq1->getCaractere('forme'); */
/* echo "*<br />"; */
/* echo $pq1; */
/* echo "**<br />"; */
/* $pq2 = new PieceQuarto(1,0,1,1); */
/* echo $pq2; */
/* echo "***<br />"; */
/* echo $pq1->compareCaractere('forme',$pq2); */
/* echo "****<br />"; */
/* echo $pq1->compareCaractere('motif',$pq2)?"$":"false"; */
/* echo "*****<br />"; */


?>

