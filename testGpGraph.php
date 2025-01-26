<?php

require_once('jpgraph/jpgraph/src/jpgraph.php');

require_once('jpgraph/jpgraph/src/jpgraph_line.php');

// Créer un graphique linéaire
$graph = new Graph(350,230);
$graph->title->Set('line plot');
$graph->SetScale("textlin");
$data = [10, 30, 50, 20, 40];
$lineplot = new LinePlot($data);
$graph->Add($lineplot);
$graph->Stroke();

?>
