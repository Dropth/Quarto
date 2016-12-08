<?php

/*
	Classe complété par Alline Florian
	InfoWeb TP3 - Quarto
*/

require_once("BoitePieceQuarto.php");
require_once("BoiteMaterielQuarto.php");
require_once("ActionQuarto.php");
require_once("MaterielQuarto.php");
require_once("PieceQuarto.php");
require_once("Point.php");


// TODO: Fonction d'affichage permettant d'écrire les entête et le début de la page HTML.
// Fonction a adapter pour votre mise en page perso...
function getHeader(){
  echo "
<!doctype html>
<html>
<head>
  <title>Quarto !</title>
  <link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\" />
</head>
<body>
  <div class=\"quarto\">

          <h1 class=\"quartoTitre\">Quarto !</h1>
  ";
}

// TODO: Fonction d'affichage pour le fin de la page. A personnaliser.
function getFooter(){
  echo "
</div>
<div><font size=-1>Cree par Alline Florian - L3 Informatique</font></div>
</body>
</html>
  ";

} 
 
// On commence par ouvrir une session. Si le cookie de session est présent dans la requête, 
// les données sauvegardées à l'appel précédent seront disponibles. 
session_start();


// La variable `transition` passée en champ "hidden" 
// des formulaires va nous aider a déterminer le nouvel état.
if (isset($_GET['transition'])) {
  $transition = $_GET['transition'];
}
else {
  $transition = "débuter";
}


// TODO: Vérifier si la variable globale de session existe. 
// Si oui récupérer une **référence** de l'instance `MaterielQuarto` stokée, 
// sinon, créer une nouvelle instance. 


if (isset($_SESSION['materiel'])) {
    //Si la partie viens est gagnante ou nul on arrète la session et on réinitialise $mq
    if ($transition == "gagné" || $transition == "nul" || $transition == "abandonné"){
        session_destroy();
        $mq = new MaterielQuarto();
    }else{
        $mq = $_SESSION['materiel'];
    }
}
else {
    $mq = new MaterielQuarto();
    $_SESSION['materiel'] = $mq;
}


// A partir de l'objet MaterielQuarto on peut instancier  BoiteMaterielQuarto et ActionQuarto
$bpq = new BoiteMaterielQuarto($mq);
$aq = new ActionQuarto($mq);

// TODO : On joue le coup à jouer s'il y a lieu puis on décide de la valeur du 
// nouvel état ("nul", "gagné", "abandonné", "activé" ou "joué")

switch($transition) {
  case "jouer":
    /* TODO */
	
		
		if (isset ($_GET['coord'])) {
		
			$coord = explode("_",$_GET['coord']);
			
			$aq->posePieceActive(new Point ($coord[0],$coord[1]));
			
			$etat="joué";
			
			if ($aq->isPartieGagnante()){
			
				$etat="gagné";
			}
			
			if ($aq->isPartieNulle()) {
				$etat="nul";
			}
		}
	
    break;
  case "abandonner":
    /* TODO */
	$etat = "abandonné";
	
    break;
  case "activer":
    
		if (isset ($_GET['pieceAct'])) {
		
			$piece = $_GET['pieceAct'];
		}
		else {
			$piece = null;
		}
		
		$aq->activePiece($piece);
		
		$etat = "activé";
	
    break;
  default:
    $etat="joué";
}



// On connaît maintenant le nouvel état courant ($etat), 
// on peut appeler la méthode correspondante dans BoiteMaterielQuarto 
// pour construire la page Web.
getHeader();

switch($etat) {
  case "joué":
    $bpq->getEtatJoue();
    break;
  case "activé":
    $bpq->getEtatActive();
    break;
  case "abandonné":
    $bpq->getEtatAbandonne();
    break;
  case "gagné":
    $bpq->getEtatGagne();
    break;
  case "nul":
    $bpq->getEtatNul();
    break;
}
getFooter();

?>