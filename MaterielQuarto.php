<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe MaterielQuarto
 *
 * @author Dominique Fournier
 * @date 2014/01
 */

require_once("Point.php");
require_once("PieceQuarto.php");

class QuartoException extends Exception { }

class MaterielQuarto {

  protected $pieceActive;
  protected $piecesDispos;
  protected $plateau;

  /**
   * constructeur
   * initialise les 16 pieces différentes du jeu et les place dans le tableau piecesDispos
   * initialise plateau avec des null
   */
  public function __construct() {
    $this->piecesDispos = array();
    $this->piecesDispos[] = new PieceQuarto(0,0,0,0); // 0 1
    $this->piecesDispos[] = new PieceQuarto(0,0,0,1); // 1 4
    $this->piecesDispos[] = new PieceQuarto(0,0,1,0); // 2 5
    $this->piecesDispos[] = new PieceQuarto(0,0,1,1); // 3 8
    $this->piecesDispos[] = new PieceQuarto(0,1,0,0); // 4 2
    $this->piecesDispos[] = new PieceQuarto(0,1,0,1); // 5 3
    $this->piecesDispos[] = new PieceQuarto(0,1,1,0); // 6 6
    $this->piecesDispos[] = new PieceQuarto(0,1,1,1); // 7 7
    $this->piecesDispos[] = new PieceQuarto(1,0,0,0); // 8 9
    $this->piecesDispos[] = new PieceQuarto(1,0,0,1); // 9 12
    $this->piecesDispos[] = new PieceQuarto(1,0,1,0); // a 13
    $this->piecesDispos[] = new PieceQuarto(1,0,1,1); // b 16
    $this->piecesDispos[] = new PieceQuarto(1,1,0,0); // c 10
    $this->piecesDispos[] = new PieceQuarto(1,1,0,1); // d 11
    $this->piecesDispos[] = new PieceQuarto(1,1,1,0); // e 14
    $this->piecesDispos[] = new PieceQuarto(1,1,1,1); // f 15

    sort($this->piecesDispos);

    $this->plateau = array(array());
    for ($i=0; $i<4; $i++) {
      for ($j=0; $j<4; $j++) {
	$this->plateau[$i][$j]= null; //"( __ )";
      }
    }

  }

   /**
   * accesseur getPiecesDispos
   * @return piecesDispos
   */
  public function getPiecesDispos() {
    return $this->piecesDispos;
  }

  /**
   * accesseur getPieceDispo
   * @param i l'indice de la pice
   * @return piecesDispos[i]
   */
  public function getPieceDispo($i) {
    return $this->piecesDispos[$i];
  }

  /**
   * méthode removePieceDispo
   * @param pq une instance de PieceQuarto
   * supprime pq de piecesDispos
   * tri piecesDispos
   */
  public function removePieceDispo(PieceQuarto $pq) {
    $this->piecesDispos = array_diff($this->piecesDispos, array($pq));
    sort($this->piecesDispos);
  }

 /**
   * méthode addPieceDispo
   * @param pq une instance de PieceQuarto
   * ajoute pq dans piecesDispos
   * tri piecesDispos
   */
  public function addPieceDispo(PieceQuarto $pq) {
    $this->piecesDispos[] = $pq;
    sort($this->piecesDispos);
  }

  /**
   * accesseur getPieceActive
   * @return pieceActive
   */
  public function getPieceActive() {
    return $this->pieceActive;
  }
  
  /**
   * modifieur setPieceActive
   * @param pq une instance de PieceQuarto
   */
  public function setPieceActive(PieceQuarto $pq = null) {
    return $this->pieceActive = $pq;
  }
  
  /**
   * accesseur getPlateau
   * @return plateau
   */
  public function getPlateau() {
    return $this->plateau;
  }

  /**
   * accesseur getPiecePlateau
   * @param p une instance de Point
   * @return l'instance de PieceQuarto située au coordonnées indiquées par p
   */
  public function getPiecePlateau(Point $p) {
    return $this->plateau[$p->getX()][$p->getY()];
  }
  
  /**
   * modifieur setPiecePlateau
   * @param p un Point
   * @param pq une PieceQuarto
   */
  public function setPiecePlateau(Point $p, PieceQuarto $pq) {
    return $this->plateau[$p->getX()][$p->getY()] = $pq;
  }
  
  /**
   * __toString renvoi une chaine en texte brut représentant l'objet
   * @return toString
   */
  public function __toString() {
    $resu = "Disponibles [";
    foreach ($this->piecesDispos as $piece)
      $resu .= $piece." ";
    $resu .= "]<br />\nActive [";
    $resu .= $this->pieceActive."]<br />\n";
    for ($i=0; $i<4; $i++) {
      $resu .= "[";
      for ($j=0; $j<4; $j++) {
	if (isset($this->plateau[$i][$j]))
	  $resu .= $this->plateau[$i][$j];
	else
	  $resu .= "( .. )";
      }
      $resu .= "]<br />";
    }
    return $resu;
  }

} // fin de la classe

/* script de test */

/* $mq = new MaterielQuarto();  */
/* echo $mq; *\/ */
/* echo "activation <br />"; */
/* $mq->activePiece(rand(0,15)); */
/* echo $mq; */
/* echo "re-activation <br />"; */
/* $mq->activePiece(rand(0,14)); */
/* echo $mq; */
/* echo "desactivation <br />"; */
/* $mq->desactivePiece(); */
/* echo $mq; */
/* echo "activation <br />"; */
/* $mq->activePiece(rand(0,15)); */
/* echo $mq; */
/* echo "pose piece active <br />"; */
/* $mq->posePieceActive(new Point(0,0)); */
/* echo $mq; */
/* echo "activation <br />"; */
/* $mq->activePiece(rand(0,14)); */
/* echo $mq; */
/* echo "pose piece active <br />"; */
/* $mq->posePieceActive(new Point(2,2)); */
/* echo $mq; */
/* echo "activation <br />"; */
/* $mq->activePiece(rand(0,13)); */
/* echo $mq; */
/* echo "pose piece active au mauvais endroit<br />"; */
/* $mq->posePieceActive(new Point(5,2)); */
/* echo $mq; */

?>
