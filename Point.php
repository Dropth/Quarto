<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe Point
 *
 * @author Dominique Fournier
 * @date 2014/01
 */
class Point {

  /* $x, $y : coordonnées d'une case en entier
  */
  protected $x;
  protected $y;

  /* 
   * méthode STATIQUE initPointCoord
   * @param formString une chaine de caractère représentant 
   *        les coordonnées d'une case de la forme 'x-y' 
   *        (avec le symbole '-' comme séparateur)
   * @return une nouvelle instance de Point 
   */

  public static function initPointCoord($formString) {
  $xy = explode("-",$formString);
  return new Point($xy[0],$xy[1]);
  }

  /**
   *  Constructeur
   *  @param les coordonnées x et y de la nouvelle instance
   */
  public function __construct($x,$y) {
    $this->x = $x;
    $this->y = $y;
  }

  /**
   * Destructeur
   * (inutile)
   */
  public function __destruct() {
    /* echo "destruction de ". $this; */
  }

  /**
   * accesseur de x
   * @return x
   */
  public function getX() {
    return $this->x;
  }

  /**
   * accesseur de y
   * @return y
   */
  public function getY() {
    return $this->y;
  }

  /**
   * modifieur de x
   * @param x 
   */
  public function setX($x) {
    $this->x = $x;
  }

  /**
   * modifieur de y
   * @param y
   */
  public function setY($y) {
    $this->y = $y;
  }


  /**
   * méthode toString
   * @return "(x,y)" 
   */
  public function __toString() {
    return "(".$this->x . "," . $this->y . ")";
  }

} // fin de la classe

/* $p = new Point(1,1); */
/* echo $p; */

/* $p->setY(0); */
/* echo $p; */

/* $p->setX(0); */
/* echo $p; */

?>

