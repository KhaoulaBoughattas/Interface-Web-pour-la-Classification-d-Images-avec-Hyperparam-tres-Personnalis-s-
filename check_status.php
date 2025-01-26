<?php
// check_status.php

// Le fichier qui indique que le traitement est en cours
$processingFile = 'results/processing.txt';

// Vérifier si le traitement est en cours
if (file_exists($processingFile)) {
    // Le fichier existe, cela signifie que le traitement est en cours
    echo json_encode(['processing' => true]);
} else {
    // Le traitement n'est pas en cours, vérifier si les résultats sont disponibles
    $resultFile = 'results/output.txt';

    if (file_exists($resultFile)) {
        // Le fichier de résultats existe, lire et renvoyer les résultats
        $output = file_get_contents($resultFile);
        echo json_encode(['completed' => true, 'results' => $output]);
    } else {
        // Ni le fichier de traitement ni le fichier de résultats n'existent, signaler une erreur
        echo json_encode(['error' => true]);
    }
}
?>
