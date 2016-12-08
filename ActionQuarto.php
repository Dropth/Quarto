<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe ActionQuarto
 *
 * @author Dominique Fournier
 * @date 2014/01
 */

require_once("Point.php");
require_once("PieceQuarto.php");
require_once("MaterielQuarto.php");

class ActionQuarto {

  public $materielQuarto;

  /**
   * constructeur
   *
   */
  public function __construct(MaterielQuarto $mq) {
    $this->materielQuarto = $mq;
  }

  /**
   * destructeur
   *
   */
  public function __destruct() {
  }

  /**
   * __toString appelle MaterielQuarto::__toString()
   *
   */
  public function __toString() {
    return "instance d'ActionQuarto";
  }

  /**
   * méthode active piece
   * @param i la position de la piece à activer dans mq->piecesDispos
   * enleve une piece disponible et la rend active
   * rend de nouveau disponible une eventuelle piece active précédente
   */
  public function activePiece($i) {
    $oldPieceActive = $this->materielQuarto->getPieceActive();
    $newPieceActive = $this->materielQuarto->getPieceDispo($i);
    $this->materielQuarto->setPieceActive($newPieceActive);
    $this->materielQuarto->removePieceDispo($newPieceActive);
    if (isset($oldPieceActive)) {
      $this->materielQuarto->addPieceDispo($oldPieceActive);
    }
  }

  /**
   * méthode desactivePiece
   * rend disponible la piece active
   */
  public function desactivePiece() {
    $this->materielQuarto->addPieceDispo($this->materielQuarto->getPieceActive());
    $this->materielQuarto->setPieceActive();
  }

  /**
   * méthode posePieceActive
   * @param p un Point indiquant les coordonnées de la pose
   * place la piece active sur le plateau de quarto
   * la piece active est placée à null
   */
  public function posePieceActive(Point $p) {
    $pieceActive = $this->materielQuarto->getPieceActive();
    if (isset($pieceActive)) {
      try {
	if ($p->getX() >= 0 && $p->getX() <= 4 && $p->getY() >= 0 && $p->getY() <= 4) {
	  $this->materielQuarto->setPiecePlateau($p, $pieceActive);
	  $this->materielQuarto->setPieceActive();
	}
	else throw new QuartoException('Coordonnees de plateau non valides, ArrayOutOfBoundException');
      }
      catch (QuartoException $e) {
	echo 'Exception : ',  $e->getMessage(), "\n";
      }
    }
  }

  /**
   * méthode valideCoordLigne
   * @param p1, p2 deux Points
   * vérifie que les deux points forment bien une ligne horizontale, verticale ou diagonale de longeur 4 sur le plateau
   * vérifie que les quatre cases contiennent une PieceQuarto
   * suppose que p1 est le point le plus haut et le plus à gauche de la ligne
   * @return un tableau de quatre PieceQuarto ou false
   */
  public function valideCoordLigne(Point $p1, Point $p2) {
    // on suppose que la ligne($p1)>= ligne($p2)
    $array_resu = array();
    // ligne
    if  ($p1->getX()==$p2->getX() && $p1->getY()==0 && $p2->getY()==3) {
      $p3 = new Point($p1->getX(),1);
      $p4 = new Point($p1->getX(),2);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p1);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p2);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p3);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p4);
      if (isset($array_resu[0]) && isset($array_resu[1]) && isset($array_resu[2]) && isset($array_resu[3]))
	return $array_resu; 
      else return false; 
    }
    // colonne	
    if ($p1->getY()==$p2->getY() && $p1->getX()==0 && $p2->getX()==3) {
      $p3 = new Point(1,$p1->getY());
      $p4 = new Point(2,$p1->getY());
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p1);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p2);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p3);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p4);
      if (isset($array_resu[0]) && isset($array_resu[1]) && isset($array_resu[2]) && isset($array_resu[3]))
	return $array_resu; 
      else return false; 
    }
    // diagonale NO-SE
    if ($p1->getY()==$p2->getY()-3 && $p1->getX()==$p2->getX()-3) {
      $p3 = new Point(1,1);
      $p4 = new Point(2,2);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p1);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p2);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p3);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p4);
      if (isset($array_resu[0]) && isset($array_resu[1]) && isset($array_resu[2]) && isset($array_resu[3]))
	return $array_resu; 
      else return false; 
    }
    // diagonale NE-SO
    if ($p1->getY()==$p2->getY()+3 && $p1->getX()==$p2->getX()-3) {
      $p3 = new Point(1,2);
      $p4 = new Point(2,1);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p1);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p2);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p3);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p4);
      if (isset($array_resu[0]) && isset($array_resu[1]) && isset($array_resu[2]) && isset($array_resu[3]))
	return $array_resu; 
      else return false; 
    }
    return false;
  }

  /**
   * méthode valideCoordCarre
   * @param p1, p2 deux Points
   * vérifie que les deux points correspondent bien aux coins NO et SE d'un carré de 4 cases sur le plateau
   * vérifie que les quatre cases contiennent une PieceQuarto
   * suppose que p1 est le point le plus haut et le plus à gauche de la ligne
   * @return un tableau de quatre PieceQuarto ou false
   */
  public function valideCoordCarre(Point $p1, Point $p2) {
    if ($p1->getX()==($p2->getX()-1) && $p1->getY()==($p2->getY()-1)) {
      $array_resu = array();
      $p3 = new Point($p1->getX()+1,$p1->getY());
      $p4 = new Point($p1->getX(),$p1->getY()+1);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p1);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p2);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p3);
      $array_resu[] = $this->materielQuarto->getPiecePlateau($p4);
      if (isset($array_resu[0]) && isset($array_resu[1]) && isset($array_resu[2]) && isset($array_resu[3]))
	return $array_resu; 
      else return false; 
    }
    return false;
  }

  /**
   * méthode isPartieGagnante
   * teste si une combinaison gagnante estprésente sur le plateau
   */
  public function isPartieGagnante() {
    $p1 = new Point(0,0);
    $p2 = new Point(3,0);
    // test lignes horizontales
    for ($y=0;$y<4;$y++) {
      $p1->setY($y);
      $p2->setY($y);
      if ($this->valideCoordLigne($p1,$p2) && PieceQuarto::isQuarto($this->valideCoordLigne($p1,$p2)))
	return true;
    }
    // test lignes verticales
    $p1 = new Point(0,0);
    $p2 = new Point(0,3);
    for ($x=0;$x<4;$x++) {
      $p1->setX($x);
      $p2->setX($x);
      if ($this->valideCoordLigne($p1,$p2) && PieceQuarto::isQuarto($this->valideCoordLigne($p1,$p2)))
	return true;
    }
    // test diagonale NO-SE
    $p1 = new Point(0,0);
    $p2 = new Point(3,3);
    if ($this->valideCoordLigne($p1,$p2) && PieceQuarto::isQuarto($this->valideCoordLigne($p1,$p2)))
      return true;
    // test diagonale NE-SO
    $p1 = new Point(0,3);
    $p2 = new Point(3,0);
    if ($this->valideCoordLigne($p1,$p2) && PieceQuarto::isQuarto($this->valideCoordLigne($p1,$p2)))
      return true;
    // carrés
    $p1 = new Point(0,0);
    $p2 = new Point(1,1);
    for ($x=0;$x<3;$x++) {
      $p1->setX($x);
      $p2->setX($x+1);
      for ($y=0;$y<3;$y++) {
	$p1->setY($y);
	$p2->setY($y+1);
	if ($this->valideCoordCarre($p1,$p2) && PieceQuarto::isQuarto($this->valideCoordCarre($p1,$p2)))
	  return true;
      }
    }
  }

  /**
   * méthode isPartieNulle
   * teste s'il y a match nul
   */
  function isPartieNulle() {
    $lesPieces = $this->materielQuarto->getPiecesDispos();
    return empty($lesPieces);
  }

}