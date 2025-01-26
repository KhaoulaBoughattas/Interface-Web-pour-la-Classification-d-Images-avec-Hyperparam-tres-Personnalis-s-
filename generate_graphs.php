<?php
require_once('jpgraph/jpgraph/src/jpgraph.php');
require_once('jpgraph/jpgraph/src/jpgraph_line.php');

$graph_type = isset($_GET['type']) ? $_GET['type'] : 'accuracy';

if ($graph_type === 'accuracy') {
    $data = [0.6, 0.7, 0.75, 0.8, 0.85];
    $labels = ['Epoch 1', 'Epoch 2', 'Epoch 3', 'Epoch 4', 'Epoch 5'];

    $graph = new Graph(400, 300);
    $graph->SetScale('textlin');
    $graph->SetMargin(40, 20, 20, 40);

    $graph->title->Set('Model Accuracy');
    $graph->xaxis->SetTickLabels($labels);
    $graph->yaxis->title->Set('Accuracy');

    $lineplot = new LinePlot($data);
    $lineplot->SetColor('blue');
    $lineplot->SetWeight(2);

    $graph->Add($lineplot);
} elseif ($graph_type === 'loss') {
    // Sample data for Model Loss
    $data = [1.0, 0.8, 0.6, 0.4, 0.3];
    $labels = ['Epoch 1', 'Epoch 2', 'Epoch 3', 'Epoch 4', 'Epoch 5'];

    // Create Loss Graph
    $graph = new Graph(400, 300);
    $graph->SetScale('textlin');
    $graph->SetMargin(40, 20, 20, 40);

    // Set titles and labels
    $graph->title->Set('Model Loss');
    $graph->xaxis->SetTickLabels($labels);
    $graph->yaxis->title->Set('Loss');

    // Create a Line Plot
    $lineplot = new LinePlot($data);
    $lineplot->SetColor('red');
    $lineplot->SetWeight(2);

    // Add the plot to the graph
    $graph->Add($lineplot);
}

// Output the graph as an image
header('Content-Type: image/png');
$graph->Stroke();
?>
