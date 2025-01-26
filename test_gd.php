<?php
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_line.php');

$data = [1, 3, 2, 5, 7];

// Créer un graphique
$graph = new Graph(400, 300);
$graph->SetScale("textlin");

// Ajouter une courbe
$lineplot = new LinePlot($data);
$graph->Add($lineplot);

// Afficher le graphique
$graph->Stroke();
?>
