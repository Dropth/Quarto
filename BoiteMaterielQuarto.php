<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe BoiteMaterielQuarto
 *
 * @author Dominique Fournier
 * @date 2014/01
 */
 
 /*
	Classe complété par Alline Florian
	InfoWeb TP3 - Quarto
*/


require_once("MaterielQuarto.php");
require_once("BoitePieceQuarto.php");

class BoiteMaterielQuarto {

  protected $mq;

  public function __construct(MaterielQuarto $mq) {
    $this->mq = $mq;
  }

  /**
   * retourne une division contenant la représentation des pieces du jeu non jouées
   * les pièces sont représentées par des BoitePieceQuartos mais ne sont pas cliquables.
   */
  public function getDivDisponibles() {
    
	$cpt =0;	
    $pieceDispo = $this->mq->getPiecesDispos();
    
    $s = "<div class =\"dispo \">";
    $s .= "</br>";
    
    for ($i=0; $i < count($pieceDispo); $i++) {
	
		if ($cpt==4) {
			$s .= "</br>"; 
			$cpt=0;
		}
        
        $bpq = new BoitePieceQuarto($pieceDispo[$i]);
        
        $s .= $bpq->__toString();
		
		$cpt++;
        
    }
    
    return $s."</div>";
  }

  /**
   * Retourne une division contenant la représentation de la pièce active du jeu.
   * 
   */
  public function getDivActive() {  
   /* TODO */
      
    $pieceAct = $this->mq->getPieceActive();
     
    $s = "<div =\"active\">";
    $s .= "</br>";
    
    if($pieceAct == null) 
		$s .= "";
    else {
        
        $bpq = new BoitePieceQuarto($pieceAct);
        
        $s .= $bpq->__toString();
    }
        
    $s .= "</br>";    
    
    return $s."</div>";
    
    
  }

  /**
   * Retourne une division contenant la représentation du plateau de jeu
   * les pieces sont représentées par des BoitePieceQuartos
   */
  public function getDivPlateau() {
    /* TODO */
      
      $plateau = $this->mq->getPlateau();
      
      $s = "<div =\"plateau\">";
      $s .= "</br>";
      
      for ($i = 0; $i < 4; $i++) {
          
          for ($j = 0; $j < 4; $j++) {
          
				if($plateau[$i][$j] != null ){
                    $img = new BoitePieceQuarto($plateau[$i][$j]);
                    $s .= "<button type=\"button\">";
                    $s .= $img;
                    $s .= "</button>";
                }
                else {
                    $img = new BoitePieceQuarto(null);
                    $s .= "<button type='button'>";
                    $s .= $img;
                    $s .= "</button>";
                }
           }
           
           $s .= "</br>";
      }
      
      $s .= "</br>";    
    
      return $s."</div>";
  }

  /**
   * Retourne une division contenant la représentation "interactive" du plateau de jeu
   * les pieces sont représentées par des BoitePieceQuartos. 
   * 
   * Un formulaire permet de poser la pièce active sur les cases vides du plateau.
   * 
   * Attention formulaire bouclant sur lui-même (action='$_SERVER['PHP_SELF']').
   */
  public function getFormPoser() {
    /* TODO */
      
      $plateau = $this->mq->getPlateau();
      //$pieceAct = $this->mq.getPieceActive();
      $s="";
      
      $s = "<div =\"formPoser\">";
      $s .= "</br>";
      
      $act = "".$_SERVER ['PHP_SELF'];
      
      $s .=  "<form name=\"form\" method=\"get\" action='$act'>";
	  
	  $s .="<input type='hidden'  name='transition' value='jouer'>";
      
       for ($i = 0; $i < 4; $i++) {
          
          for ($j = 0; $j < 4; $j++) {
              
              if($plateau[$i][$j] != null ){
                    $img = new BoitePieceQuarto($plateau[$i][$j]);
                    $s .= "<button type=\"button\" name=\"coord\" value=\"" . $i . "_" . $j . "\" >";
                    $s .= $img;
                    $s .= "</button>";
                }
                else {
                    $img = new BoitePieceQuarto(null);
                    $s .= "<button type=\"submit\" name=\"coord\" value=\"" . $i . "_" . $j . "\" >";
                    $s .= $img;
                    $s .= "</button>";
                }
           }
           
           $s .= "</br>";
      }
        
      $s .= "</form>";
      
      $s .= "</br>";    
    
      return $s."</div>";
  }

  /**
   * Retourne une division contenant la représentation des pièces du jeu non jouées.
   * Les pièces sont représentées par des BoitePieceQuartos. 
   * 
   * Elles sont contenues dans un formulaire permettant de sélectionner une de ces 
   * pièces disponibles pour l'activer. 
   * 
   * Attention formulaire bouclant sur lui-même (action='$_SERVER['PHP_SELF']').
   */
  public function getFormActiver() {
      
	  $cpt=0;
	  $pieceDispo = $this->mq->getPiecesDispos();
      $s="";
      
      $s = "<div> <form name=\"transition\" method=\"GET\"";
      $s .= 'action="'.$_SERVER['PHP_SELF'].'">';
      $s .= "<input type=\"hidden\" name=\"transition\" value=\"activer\"/>";
      
       foreach ($this->mq->getPiecesDispos() as $key=>$element){
	   
		if($cpt==4) {
			$s .= "<br>";
			$cpt=0;
		}
	   
        $img = new BoitePieceQuarto($element);
        $s=$s."<button type='submit' name='pieceAct' value='$key' border='0'>";
        $s=$s.$img;
        $s=$s."</button>";
		
		$cpt++;
    }
        
      $s .= "</form>";
      
      $s .= "</br>";    
    
      return $s."</div>";
  }
  
  public function getBoutonAbandon(){
    $s="<div>\n";
    $action = "".$_SERVER['PHP_SELF'];
    $form ="<form id='abandon' method='GET' action='$action' >\n";
    $s.=$form;
    $s.="<input type='hidden' name='transition' value='abandonner'>\n";
    $s.="<button type='submit'>Abandonner la partie</button>\n";
    $s.="</form>\n</div>";
    return $s;
  }
  public function getBoutonRecommencer(){
    $s="<div>\n";
    $action = "".$_SERVER['PHP_SELF'];
    $form ="<form id='abandon' method='GET' action='$action' >\n";
    $s.=$form;
    $s.="<input type='hidden' name='transition' value='debuter'>\n";
    $s.="<button type='submit'>Recommencer une partie</button>\n";
    $s.="</form>\n</div>";
    return $s;
  }


  /**
   * État "joué".
   * Génère l'affichage complet (3 zones de jeu plus messages éventuels) pour cet état.
   */
  public function getEtatJoue(){
    /* TODO */
	
    echo "<br/>Plateau <br/>" . $this->getDivPlateau();    
    echo "<br/>Piece Active <br/>" . $this->getDivActive();
    echo "<br/>Piece disponible <br/>" . $this->getFormActiver();
	echo "<br/>Voulez-vous abandonner la partie ? <br/>" . $this->getBoutonAbandon();
	
    
    echo "<br/>";
    echo "<br/>";
    
    //echo "" . $this->getFormPoser();
    //echo "" . $this->getFormActiver();
  }

  /**
   * État "activé".
   * Génère l'affichage complet (3 zones de jeu plus messages éventuels) pour cet état.
   */
  public function getEtatActive(){
    /* TODO */
	
	echo "<br/>Plateau <br/>" . $this->getFormPoser();    
    echo "<br/>Piece Active <br/>" . $this->getDivActive();
    echo "<br/>Piece disponible <br/>" . $this->getDivDisponibles();
	echo "<br/>Voulez-vous abandonner la partie ? <br/>" . $this->getBoutonAbandon();
    
    echo "<br/>";
    echo "<br/>";
  }

  /**
   * État "gagné".
   * Génère l'affichage complet (3 zones de jeu plus messages éventuels) pour cet état.
   *
   * Attention cet état est terminal. Il n'est plus question de jouer de coup après cela. 
   * La session doit être supprimé après l'affichage. 
   */
  public function getEtatGagne(){
    echo "<h2>La Partie est GAGNEE</h2>";
    //echo $this->getActive();
    echo $this->getDivPlateau();
    echo $this->getDivDisponibles();
	
	echo "<br>Vous avez gagne la partie ! Voulez-vous recommencer ?<br><br>";
    echo $this->getBoutonRecommencer();
	session_destroy();
  }

  /**
   * État "nul".
   * Génère l'affichage complet (3 zones de jeu plus messages éventuels) pour cet état.
   *
   * Attention cet état est terminal. Il n'est plus question de jouer de coup après cela. 
   * La session doit être supprimé après l'affichage. 
   */
  public function getEtatNul(){
    echo "<h2>La Partie est NULLE</h2>";
    echo $this->getDivPlateau();
    echo $this->getDivDisponibles();
	
	echo "<br>Vous avez gagne la partie ! Voulez-vous recommencer ?<br><br>";
    echo $this->getBoutonRecommencer();
	session_destroy();
  }

  /**
   * État "abandonné".
   * Génère l'affichage complet (3 zones de jeu plus messages éventuels) pour cet état.
   *
   * Attention cet état est terminal. Il n'est plus question de jouer de coup après cela. 
   * La session doit être supprimé après l'affichage et un lien proposant une nouvelle partie devrait être proposé. 
   */
  public function getEtatAbandonne(){
    echo "<h2>La Partie est ABANDONNEE</h2>";
    echo $this->getDivPlateau();
    echo $this->getDivDisponibles();
	
    echo "<br>Vous avez gagne la partie ! Voulez-vous recommencer ?<br><br>";
    echo $this->getBoutonRecommencer();
	session_destroy();
  }
  

  public function __toString() {
    return "Afficheur";
  }
}


?>