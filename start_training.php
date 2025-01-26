<?php
// Récupérer les hyperparamètres envoyés par le formulaire
$learningRate = $_POST['learningRate'];
$epochs = $_POST['epochs'];
$patience = $_POST['patience'];
$monitor = $_POST['monitor'];
$optimizer = $_POST['optimizer'];
$modelName = $_POST['modelName'];
$activationFunction = $_POST['activationFunction'];
$validationSplit = $_POST['validationSplit'];
$testSplit = $_POST['testSplit'];
$imageDirectory = $_POST['imageDirectory'];

// Construire la commande pour exécuter le script Python
$command = escapeshellcmd("python train_model.py $learningRate $epochs $patience $monitor $optimizer $modelName $activationFunction $validationSplit $testSplit $imageDirectory");

// Exécuter le script et capturer la sortie
$output = shell_exec($command);

// Afficher le résultat
echo "<pre>$output</pre>";
?>
